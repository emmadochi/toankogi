<?php

namespace App\Controllers;

use App\Core\Controller;

class Admin extends Controller
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
        
        // Skip auth check for login method
        $method = $this->getMethodFromUrl();
        
        if ($method !== 'login' && !isLoggedIn()) {
             $this->requireAuth();
        }
    }

    /**
     * Helper to get the method name from URL
     */
    private function getMethodFromUrl()
    {
        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            return isset($url[1]) ? $url[1] : 'index';
        }
        
        // Fallback for servers not using .htaccess
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath = dirname($scriptName);
        
        if ($basePath !== '/' && $basePath !== '\\' && strpos($requestUri, $basePath) === 0) {
            $urlPath = substr($requestUri, strlen($basePath));
        } else {
            $urlPath = $requestUri;
        }

        $urlParts = explode('/', trim($urlPath, '/'));
        return isset($urlParts[1]) ? $urlParts[1] : 'index';
    }

    public function index()
    {
        $role = $_SESSION['user_role'];
        $lga_id = $_SESSION['user_lga_id'];
        $unit_id = $_SESSION['user_unit_id'];

        $stats = $this->adminModel->getScopedDashboardStats($role, $lga_id, $unit_id);
        $lgaRevenue = $this->adminModel->getScopedLgaRevenue($role, $lga_id);

        $data = [
            'title' => 'Admin Dashboard | ' . SITENAME,
            'active_page' => 'dashboard',
            'stats' => $stats,
            'lgaRevenue' => $lgaRevenue
        ];
        
        $this->view('admin/index', $data);
    }

    public function login()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => '',
            ];

            // Validate Username
            if (empty($data['username'])) {
                $data['username_err'] = 'Please enter username';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/username
            if (empty($data['username_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->adminModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect or user not found';
                    $this->view('admin/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('admin/login', $data);
            }

        } else {
            // Init data
            $data = [
                'title' => 'Admin Access | ' . SITENAME,
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => '',
            ];

            // Load view
            $this->view('admin/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_name'] = $user->fullname;
        $_SESSION['user_fullname'] = $user->fullname;

        $_SESSION['user_role'] = $user->role;
        $_SESSION['user_lga_id'] = $user->lga_id;
        $_SESSION['user_unit_id'] = $user->unit_id;
        $_SESSION['user_lga_name'] = $user->lga_name;
        $_SESSION['user_unit_name'] = $user->unit_name;

        
        session_write_close();
        redirect('admin/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_lga_id']);
        unset($_SESSION['user_unit_id']);
        unset($_SESSION['user_lga_name']);
        unset($_SESSION['user_unit_name']);
        session_destroy();
        
        flash('admin_login_error', 'Successfully logged out.', 'alert alert-success');
        redirect('admin/login');

    }

    public function members()
    {
        $role = $_SESSION['user_role'];
        $lga_id = $_SESSION['user_lga_id'];
        $unit_id = $_SESSION['user_unit_id'];

        $members = $this->adminModel->getScopedMembers($role, $lga_id, $unit_id);
        $stats = $this->adminModel->getScopedDashboardStats($role, $lga_id, $unit_id);

        $data = [
            'title' => 'Manage Members | ' . SITENAME,
            'active_page' => 'members',
            'members' => $members,
            'stats' => $stats
        ];
        
        $this->view('admin/members', $data);
    }

    public function registration()
    {
        $this->requireRole(['superadmin', 'lga_admin', 'unit_admin']);
        $settingsModel = $this->model('Settings');
        $regFee = $settingsModel->getSetting('registration_fee') ?: 2000;
        $paystackKey = $settingsModel->getSetting('paystack_public_key');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $passport_path = null;

            // Handle Passport Upload
            if (isset($_FILES['passport_image']) && $_FILES['passport_image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['passport_image'];
                $allowed = ['image/jpeg', 'image/jpg', 'image/png'];
                
                if (in_array($file['type'], $allowed) && $file['size'] <= 2000000) {
                    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $filename = uniqid('passport_') . '.' . $ext;
                    $target = PUBROOT . '/uploads/passports/' . $filename;
                    
                    if (move_uploaded_file($file['tmp_name'], $target)) {
                        $passport_path = 'uploads/passports/' . $filename;
                    }
                }
            }

            $data = [
                'fullname' => trim($_POST['fullname']),
                'phone' => trim($_POST['phone']),
                'plate_number' => strtoupper(trim($_POST['plate_number'])),
                'lga_id' => trim($_POST['lga_id']),
                'unit_id' => trim($_POST['unit_id']),
                'password' => password_hash(trim($_POST['phone']), PASSWORD_DEFAULT), // Default password is phone
                'added_by' => $_SESSION['user_id'],
                'passport_image' => $passport_path
            ];

            $paystack_ref = trim($_POST['paystack_reference'] ?? '');
            if (empty($paystack_ref)) {
                flash('reg_msg', 'Payment verification reference is missing.', 'alert alert-danger');
                redirect('admin/registration');
            }

            $newMemberId = $this->adminModel->createMember($data);
            
            if ($newMemberId) {
                // Record Registration Fee as online with Paystack ref
                $paymentData = [
                    'member_id' => $newMemberId,
                    'amount' => $regFee,
                    'payment_type' => 'registration',
                    'method' => 'online',
                    'reference' => $paystack_ref,
                    'agent_id' => $_SESSION['user_id']
                ];
                $trx_id = $this->adminModel->recordPayment($paymentData);
                
                redirect('admin/registration_success?id=' . $newMemberId . '&trx_id=' . $trx_id);
            } else {
                flash('reg_msg', 'Something went wrong', 'alert alert-danger');
                redirect('admin/registration');
            }
        }


        $lgas = $this->adminModel->getLgas();
        
        // Fetch all units and group by LGA for dynamic dropdown
        $allUnits = [];
        foreach($lgas as $lga) {
            $allUnits[$lga->id] = $this->adminModel->getUnitsByLga($lga->id);
        }

        $data = [
            'title' => 'Member Registration | ' . SITENAME,
            'active_page' => 'registration',
            'lgas' => $lgas,
            'unitsByLga' => $allUnits,
            'registration_fee' => $regFee,
            'paystack_public_key' => $paystackKey
        ];
        
        $this->view('admin/registration', $data);
    }

    public function payment()
    {
        $settingsModel = $this->model('Settings');
        $regFee = $settingsModel->getSetting('registration_fee') ?: 2000;
        $paystackKey = $settingsModel->getSetting('paystack_public_key');
        $dailyRate = $settingsModel->getSetting('daily_rate') ?: 200;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $member_id = trim($_POST['member_id']);
            $amount = trim($_POST['amount']);
            $payment_type = trim($_POST['payment_type']);
            $paystack_ref = trim($_POST['paystack_reference'] ?? '');

            if (!empty($member_id) && !empty($amount) && !empty($paystack_ref)) {
                $paymentData = [
                    'member_id' => $member_id,
                    'amount' => $amount,
                    'payment_type' => $payment_type,
                    'method' => 'online',
                    'reference' => $paystack_ref,
                    'agent_id' => $_SESSION['user_id']
                ];

                $trx_id = $this->adminModel->recordPayment($paymentData);

                if ($trx_id) {
                    redirect('admin/receipt?trx_id=' . $trx_id);
                } else {
                    die('Something went wrong recording the payment.');
                }
            } else {
                flash('admin_msg', 'Payment verification reference is missing.', 'alert alert-danger');
                redirect('admin/payment');
            }
        }

        $data = [
            'title' => 'Process Payment | ' . SITENAME,
            'active_page' => 'payment',
            'registration_fee' => $regFee,
            'paystack_public_key' => $paystackKey,
            'daily_rate' => $dailyRate
        ];
        
        $this->view('admin/payment', $data);
    }

    public function revenue()
    {
        $role = $_SESSION['user_role'];
        $lga_id = $_SESSION['user_lga_id'];
        $unit_id = $_SESSION['user_unit_id'];

        $revenue = $this->adminModel->getScopedRevenue($role, $lga_id, $unit_id);
        $stats = $this->adminModel->getScopedDashboardStats($role, $lga_id, $unit_id);

        $data = [
            'title' => 'Revenue Logs | ' . SITENAME,
            'active_page' => 'revenue',
            'revenue' => $revenue,
            'stats' => $stats
        ];
        
        $this->view('admin/revenue', $data);
    }

    public function lgas()
    {
        // Only Super Admin can see this
        $this->requireRole(['superadmin']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'code' => strtoupper(trim($_POST['code']))
            ];
            if ($this->adminModel->createLga($data)) {
                flash('lga_msg', 'LGA added successfully');
            } else {
                flash('lga_msg', 'Something went wrong', 'alert alert-danger');
            }
            redirect('admin/lgas');
        }

        $lgas = $this->adminModel->getLgas();

        $data = [
            'title' => 'Regional Setup - LGAs | ' . SITENAME,
            'active_page' => 'lgas',
            'lgas' => $lgas
        ];
        
        $this->view('admin/lgas', $data);
    }

    public function units()
    {
        // Super Admin and LGA Admin can see this
        $this->requireRole(['superadmin', 'lga_admin']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            if ($_POST['action'] == 'add_unit') {
                $data = [
                    'lga_id' => trim($_POST['lga_id']),
                    'name' => trim($_POST['name']),
                    'code' => strtoupper(trim($_POST['code'])),
                    'bank_code' => isset($_POST['bank_code']) ? trim($_POST['bank_code']) : null,
                    'account_number' => isset($_POST['account_number']) ? trim($_POST['account_number']) : null
                ];
                if ($this->adminModel->createUnit($data)) {
                    flash('unit_msg', 'Unit added successfully');
                } else {
                    flash('unit_msg', 'Something went wrong', 'alert alert-danger');
                }
                redirect('admin/units?lga_id=' . $data['lga_id']);
            } elseif ($_POST['action'] == 'edit_unit') {
                $id = trim($_POST['id']);
                $data = [
                    'lga_id' => trim($_POST['lga_id']),
                    'name' => trim($_POST['name']),
                    'code' => strtoupper(trim($_POST['code'])),
                    'bank_code' => isset($_POST['bank_code']) ? trim($_POST['bank_code']) : null,
                    'account_number' => isset($_POST['account_number']) ? trim($_POST['account_number']) : null
                ];
                if ($this->adminModel->updateUnit($id, $data)) {
                    flash('unit_msg', 'Unit updated successfully');
                } else {
                    flash('unit_msg', 'Something went wrong', 'alert alert-danger');
                }
                redirect('admin/units?lga_id=' . $data['lga_id']);
            } elseif ($_POST['action'] == 'delete_unit') {
                $id = trim($_POST['id']);
                $lga_id = trim($_POST['lga_id']);
                if ($this->adminModel->deleteUnit($id)) {
                    flash('unit_msg', 'Unit deleted successfully');
                } else {
                    flash('unit_msg', 'Something went wrong - unit might have associated users', 'alert alert-danger');
                }
                redirect('admin/units?lga_id=' . $lga_id);
            }
        }


        $role = $_SESSION['user_role'];
        $lgas = ($role === 'superadmin') ? $this->adminModel->getLgas() : [];

        // Fetch units based on role
        if ($role === 'superadmin') {
            $lga_id = isset($_GET['lga_id']) && !empty($_GET['lga_id']) ? $_GET['lga_id'] : ($lgas[0]->id ?? null);
        } else {
            $lga_id = $_SESSION['user_lga_id'];
        }

        $units = $this->adminModel->getUnitsByLga($lga_id);

        $data = [
            'title' => 'Regional Setup - Units | ' . SITENAME,
            'active_page' => 'units',
            'units' => $units,
            'lgas' => $lgas,
            'current_lga_id' => $lga_id
        ];

        
        $this->view('admin/units', $data);
    }

    public function verification()
    {
        // Handle AJAX Autocomplete requests
        if (isset($_GET['autocomplete'])) {
            $q = trim($_GET['autocomplete']);
            if (empty($q)) {
                echo json_encode([]);
                exit;
            }
            $results = $this->adminModel->searchMembersAutocomplete($q);
            header('Content-Type: application/json');
            echo json_encode($results);
            exit;
        }

        // Handle AJAX search requests
        if (isset($_GET['search'])) {
            $search = strtoupper(trim($_GET['search']));
            $member = $this->adminModel->getMemberBySearch($search);

            if ($member) {
                // Get configurable daily rate from settings
                $settingsModel = $this->model('Settings');
                $dailyRate = (int)($settingsModel->getSetting('daily_rate') ?: 200);

                // Find last payment of ANY type (daily, weekly, monthly)
                $lastPayment = $this->adminModel->getLastPayment($member->id);
                
                $today = date('Y-m-d');
                $paidUntil = $member->paid_until;
                
                $daysOwed = 0;
                $isCompliant = true;

                if (!$paidUntil) {
                    // New member with no tax payments yet
                    // If they just registered today, they might not owe yet? 
                    // Let's assume they owe starting from registration date if no paid_until
                    $regDate = date('Y-m-d', strtotime($member->created_at));
                    if ($regDate < $today) {
                        $diff = strtotime($today) - strtotime($regDate);
                        $daysOwed = floor($diff / (60 * 60 * 24));
                        $isCompliant = false;
                    }
                } elseif ($paidUntil < $today) {
                    // Expired tax
                    $diff = strtotime($today) - strtotime($paidUntil);
                    $daysOwed = floor($diff / (60 * 60 * 24));
                    $isCompliant = false;
                }
                
                $amountOwed = $daysOwed * $dailyRate;

                // Check if already paid today (duplicate guard)
                $paidToday = $this->adminModel->hasPaidToday($member->id);

                // Prepare response
                $response = [
                    'success' => true,
                    'member' => [
                        'id' => $member->id,
                        'fullname' => $member->fullname,
                        'unique_id' => $member->unique_id,
                        'plate_number' => $member->plate_number,
                        'status' => $member->status,
                        'passport_image' => $member->passport_image,
                        'lga' => $member->lga_name,
                        'unit' => $member->unit_name,
                        'subaccount_code' => $member->subaccount_code
                    ],
                    'tax' => [
                        'last_payment_date' => $lastPayment ? date('d M Y', strtotime($lastPayment->payment_date)) : 'N/A (New Member)',
                        'last_payment_type' => $lastPayment ? $lastPayment->payment_type : null,
                        'paid_until' => $paidUntil ? date('d M Y', strtotime($paidUntil)) : 'Never',
                        'days_owed' => $daysOwed,
                        'amount_owed' => $amountOwed,
                        'daily_rate' => $dailyRate,
                        'is_compliant' => $isCompliant,
                        'paid_today' => $paidToday
                    ]
                ];
            } else {
                $response = ['success' => false, 'message' => 'No record found for this Identification'];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        $data = [
            'title' => 'Agent Verification | ' . SITENAME,
            'active_page' => 'verification'
        ];
        
        $this->view('admin/verification', $data);
    }

    public function registration_success()
    {
        $id = $_GET['id'] ?? null;
        $trx_id = $_GET['trx_id'] ?? null;
        
        if (!$id) redirect('admin/members');
        
        $member = $this->adminModel->getMemberById($id);
        if (!$member) redirect('admin/members');

        $data = [
            'title' => 'Registration Successful | ' . SITENAME,
            'active_page' => 'registration',
            'member' => $member,
            'trx_id' => $trx_id
        ];
        
        $this->view('admin/registration_success', $data);
    }

    public function receipt()
    {
        $id = $_GET['trx_id'] ?? null;
        if (!$id) redirect('admin/revenue');

        $transaction = $this->adminModel->getTransactionById($id);
        if (!$transaction) redirect('admin/revenue');

        $data = [
            'title' => 'Digital Receipt | ' . SITENAME,
            'active_page' => 'revenue',
            'transaction' => $transaction
        ];
        
        $this->view('admin/receipt', $data);
    }

    public function sticker()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) redirect('admin/members');

        $member = $this->adminModel->getMemberById($id);
        if (!$member) redirect('admin/members');

        // Calculate expiry: 1 year from created_at
        $expiry = date('d M Y', strtotime($member->created_at . ' + 1 year'));

        $data = [
            'title' => 'Print Vehicle Sticker | ' . SITENAME,
            'active_page' => 'members',
            'member' => $member,
            'expiry' => $expiry
        ];

        $this->view('admin/sticker', $data);
    }

    public function id_card()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) redirect('admin/members');

        $member = $this->adminModel->getMemberById($id);
        if (!$member) redirect('admin/members');

        $data = [
            'title' => 'Print Member ID Card | ' . SITENAME,
            'active_page' => 'members',
            'member' => $member
        ];

        $this->view('admin/id_card', $data);
    }

    public function reports()
    {
        $this->requireRole(['superadmin', 'lga_admin']);

        $analytics = $this->adminModel->getReportsAnalytics();

        $data = [
            'title' => 'Statistical Reports | ' . SITENAME,
            'active_page' => 'reports',
            'analytics' => $analytics
        ];
        
        $this->view('admin/reports', $data);
    }

    public function complaints()
    {
        $role = $_SESSION['user_role'] ?? 'superadmin';
        $j_lga_id = $_SESSION['user_lga_id'] ?? null;
        $j_unit_id = $_SESSION['user_unit_id'] ?? null;

        // AJAX Filtering Logic
        if (isset($_GET['ajax'])) {
            $filters = [
                'lga_id' => $_GET['lga_id'] ?? 'all',
                'category' => $_GET['category'] ?? 'all',
                'status' => $_GET['status'] ?? 'all',
                'search' => $_GET['search'] ?? ''
            ];

            $complaints = $this->adminModel->getScopedComplaints($role, $j_lga_id, $j_unit_id, $filters);
            
            // Format complaints for base64 transport
            foreach($complaints as &$c) {
                $c->json_payload = base64_encode(json_encode([
                    'ticket_id' => $c->ticket_id,
                    'member' => $c->member_name,
                    'category' => $c->category,
                    'description' => $c->description,
                    'date' => date('M d, Y', strtotime($c->created_at)),
                    'status' => $c->status,
                    'admin_reply' => $c->admin_reply
                ]));
                $c->formatted_date = date('M d, Y', strtotime($c->created_at));
            }

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'complaints' => $complaints]);
            exit;
        }

        $complaints = $this->adminModel->getScopedComplaints($role, $j_lga_id, $j_unit_id);
        $lgas = $this->adminModel->getLgas();

        $data = [
            'title' => 'Member Complaints | ' . SITENAME,
            'active_page' => 'complaints',
            'complaints' => $complaints,
            'lgas' => $lgas
        ];
        
        $this->view('admin/complaints', $data);
    }

    public function resolve_complaint()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ticket_id = trim($_POST['ticket_id']);
            $status = trim($_POST['status']);
            $admin_reply = trim($_POST['admin_reply'] ?? '');

            if ($this->adminModel->updateComplaintStatus($ticket_id, $status, $admin_reply)) {
                flash('admin_msg', 'Complaint #' . $ticket_id . ' status updated to ' . $status . '!');
            } else {
                flash('admin_msg', 'Failed to update status.', 'alert alert-danger');
            }
        }
        redirect('admin/complaints');
    }

    public function users()
    {
        // Super Admin, LGA Admin and Unit Admin
        $this->requireRole(['superadmin', 'lga_admin', 'unit_admin']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
             
             if ($_POST['action'] == 'add_user' || $_POST['action'] == 'edit_user') {
                $data = [
                    'fullname' => trim($_POST['fullname']),
                    'email' => trim($_POST['email']),
                    'username' => trim($_POST['username']), 
                    'role' => trim($_POST['role']),
                    'lga_id' => !empty($_POST['lga_id']) ? $_POST['lga_id'] : null,
                    'unit_id' => !empty($_POST['unit_id']) ? $_POST['unit_id'] : null
                ];

                if($_POST['action'] == 'add_user' || !empty($_POST['password'])) {
                    $data['password'] = password_hash(trim($_POST['password'] ?: '123456'), PASSWORD_DEFAULT);
                }
                
                if($_POST['action'] == 'edit_user') {
                    $data['id'] = trim($_POST['id']);
                    $data['status'] = trim($_POST['status'] ?? 'active');
                }

                // Jurisdiction enforcement
                if($_SESSION['user_role'] === 'lga_admin') {
                    $data['lga_id'] = $_SESSION['user_lga_id'];
                }
                if($_SESSION['user_role'] === 'unit_admin') {
                    $data['lga_id'] = $_SESSION['user_lga_id'];
                    $data['unit_id'] = $_SESSION['user_unit_id'];
                }

                // Validation
                $errors = [];
                if($this->adminModel->checkUsernameExists($data['username'], $data['id'] ?? null)) {
                    $errors[] = 'Username is already taken';
                }
                if(!empty($data['email']) && $this->adminModel->checkEmailExists($data['email'], $data['id'] ?? null)) {
                    $errors[] = 'Email is already registered';
                }

                if($data['role'] !== 'superadmin' && empty($data['lga_id'])) $errors[] = 'LGA assignment is required';
                if(($data['role'] === 'unit_admin' || $data['role'] === 'agent') && empty($data['unit_id'])) $errors[] = 'Unit assignment is required';

                if (empty($errors)) {
                    if ($_POST['action'] == 'add_user') {
                        if($this->adminModel->register($data)) {
                            flash('user_msg', 'Administrator created successfully');
                        } else {
                            flash('user_msg', 'Database error occurred', 'alert alert-danger');
                        }
                    } else {
                        if($this->adminModel->updateAdmin($data['id'], $data)) {
                            flash('user_msg', 'Administrator updated successfully');
                        } else {
                            flash('user_msg', 'Database error occurred', 'alert alert-danger');
                        }
                    }
                } else {
                    flash('user_msg', implode('<br>', $errors), 'alert alert-danger');
                }
                redirect('admin/users');
             } elseif ($_POST['action'] == 'delete_user') {
                 $id = trim($_POST['id']);
                 if($this->adminModel->deleteAdmin($id)) {
                     flash('user_msg', 'User deactivated successfully');
                 } else {
                     flash('user_msg', 'Something went wrong', 'alert alert-danger');
                 }
                 redirect('admin/users');
             }
        }


        $role = $_SESSION['user_role'];
        $lga_id = $_SESSION['user_lga_id'];
        $unit_id = $_SESSION['user_unit_id'];

        $admins = $this->adminModel->getAdmins($role, $lga_id, $unit_id);
        $userStats = $this->adminModel->getScopedAdminStats($role, $lga_id, $unit_id);
        
        $lgas = ($role === 'superadmin') ? $this->adminModel->getLgas() : [];
        
        // Fetch ALL units grouped by LGA for the dynamic JS modal filtering
        $unitsByLga = [];
        $all_lgas = $this->adminModel->getLgas();
        foreach($all_lgas as $l) {
            $unitsByLga[$l->id] = $this->adminModel->getUnitsByLga($l->id);
        }

        $data = [
            'title' => 'User Roles & Access | ' . SITENAME,
            'active_page' => 'users',
            'admins' => $admins,
            'userStats' => $userStats,
            'lgas' => $lgas,
            'unitsByLga' => $unitsByLga
        ];
        
        $this->view('admin/users', $data);
    }

    public function audit()
    {
        $this->requireRole(['superadmin']);

        // Fetch audit logs
        $auditLogs = $this->adminModel->getAuditLogs();
        $auditStats = $this->adminModel->getAuditStats();

        $data = [
            'title' => 'Audit Logs | ' . SITENAME,
            'active_page' => 'audit',
            'audit_logs' => $auditLogs,
            'audit_stats' => $auditStats
        ];
        
        $this->view('admin/audit', $data);
    }

    public function settings()
    {
        $this->requireRole(['superadmin']);
        $settingsModel = $this->model('Settings');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST['action']) && $_POST['action'] === 'update_settings') {
                $settingsModel->updateSetting('registration_fee', trim($_POST['registration_fee']));
                $settingsModel->updateSetting('paystack_public_key', trim($_POST['paystack_public_key']));
                $settingsModel->updateSetting('paystack_secret_key', trim($_POST['paystack_secret_key']));
                $settingsModel->updateSetting('main_account_number', trim($_POST['main_account_number']));
                $settingsModel->updateSetting('main_bank_code', trim($_POST['main_bank_code']));

                flash('settings_msg', 'Application settings updated successfully!');
                redirect('admin/settings');
            }
        }

        $appSettings = $settingsModel->getAllSettings();

        $data = [
            'title' => 'Portal Settings | ' . SITENAME,
            'active_page' => 'settings',
            'settings' => $appSettings
        ];
        
        $this->view('admin/settings', $data);
    }
    public function member_details()
    {
        // Require ID
        if (!isset($_GET['id'])) {
            redirect('admin/members');
        }

        $id = $_GET['id'];
        $member = $this->adminModel->getMemberById($id);

        if (!$member) {
            redirect('admin/members');
        }

        // Get past payments
        $payments = $this->adminModel->getMemberPayments($id);
        
        // Get configurable daily rate from settings
        $settingsModel = $this->model('Settings');
        $dailyRate = (int)($settingsModel->getSetting('daily_rate') ?: 200);

        // Find last payment of ANY type (daily, weekly, monthly)
        $lastPayment = $this->adminModel->getLastPayment($member->id);
        
        $today = date('Y-m-d');
        $paidUntil = $member->paid_until;
        
        $daysOwed = 0;
        $isCompliant = true;

        if (!$paidUntil) {
            $regDate = date('Y-m-d', strtotime($member->created_at));
            if ($regDate < $today) {
                $diff = strtotime($today) - strtotime($regDate);
                $daysOwed = floor($diff / (60 * 60 * 24));
                $isCompliant = false;
            }
        } elseif ($paidUntil < $today) {
            $diff = strtotime($today) - strtotime($paidUntil);
            $daysOwed = floor($diff / (60 * 60 * 24));
            $isCompliant = false;
        }

        $data = [
            'title' => 'Member Details | ' . SITENAME,
            'active_page' => 'members',
            'member' => $member,
            'payments' => $payments,
            'tax' => [
                'days_owed' => $daysOwed,
                'amount_owed' => $daysOwed * $dailyRate,
                'is_compliant' => $isCompliant,
                'paid_until' => $paidUntil ? date('d M Y', strtotime($paidUntil)) : 'Never',
                'last_payment_date' => $lastPayment ? date('d M Y', strtotime($lastPayment->payment_date)) : 'N/A'
            ]
        ];

        $this->view('admin/member_details', $data);
    }
}
