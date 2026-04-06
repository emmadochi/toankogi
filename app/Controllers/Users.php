<?php

namespace App\Controllers;

use App\Core\Controller;

class Users extends Controller
{
    private $memberModel;

    public function __construct()
    {
        $this->requireMemberAuth();
        $this->memberModel = $this->model('Member');
    }

    public function force_change_password()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $new = trim($_POST['new_password'] ?? '');
            $confirm = trim($_POST['confirm_password'] ?? '');

            if (empty($new) || empty($confirm)) {
                $_SESSION['pwd_error'] = 'Please fill out all fields.';
            } elseif (strlen($new) < 6) {
                $_SESSION['pwd_error'] = 'Password must be at least 6 characters.';
            } elseif ($new !== $confirm) {
                $_SESSION['pwd_error'] = 'Passwords do not match.';
            } else {
                $member_id = $_SESSION['member_id'];
                $hashed = password_hash($new, PASSWORD_DEFAULT);
                if ($this->memberModel->updatePassword($member_id, $hashed)) {
                    $_SESSION['force_password_change'] = false;
                    flash('member_login_success', 'Password successfully secured!');
                    redirect('users/index');
                    return;
                } else {
                    $_SESSION['pwd_error'] = 'Database error occurred.';
                }
            }
        }
        
        // Go back to wherever they were
        $referer = $_SERVER['HTTP_REFERER'] ?? URLROOT . '/users/index';
        header('Location: ' . $referer);
    }

    public function update_password()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $member_id = $_SESSION['member_id'];
            $member = $this->memberModel->getMemberById($member_id);
            
            $current = trim($_POST['current_password'] ?? '');
            $new = trim($_POST['new_password'] ?? '');
            $confirm = trim($_POST['confirm_password'] ?? '');

            if (empty($current) || empty($new) || empty($confirm)) {
                flash('member_error', 'Please fill out all fields.', 'alert alert-danger');
            } elseif (!password_verify($current, $member->password)) {
                flash('member_error', 'Current password is incorrect.', 'alert alert-danger');
            } elseif (strlen($new) < 6) {
                flash('member_error', 'New password must be at least 6 characters.', 'alert alert-danger');
            } elseif ($new !== $confirm) {
                flash('member_error', 'New passwords do not match.', 'alert alert-danger');
            } else {
                $hashed = password_hash($new, PASSWORD_DEFAULT);
                if ($this->memberModel->updatePassword($member_id, $hashed)) {
                    flash('member_success', 'Password updated successfully!');
                } else {
                    flash('member_error', 'Database error occurred.', 'alert alert-danger');
                }
            }
        }
        redirect('users/profile');
    }

    public function index()
    {
        $member_id = $_SESSION['member_id'];
        $member = $this->memberModel->getMemberById($member_id);
        $recent_payments = $this->memberModel->getMemberPayments($member_id);
        $total_paid_this_month = $this->memberModel->getCurrentMonthTotal($member_id);

        $settingsModel = $this->model('Settings');
        $dailyRate = (int)($settingsModel->getSetting('daily_rate') ?: 200);
        $grace_period = 4; // Or fetch from settings

        $today = date('Y-m-d');
        $paidUntil = $member->paid_until;
        
        $outstanding_days = 0;
        $isCompliant = true;

        if (!$paidUntil) {
            $regDate = date('Y-m-d', strtotime($member->created_at));
            if ($regDate < $today) {
                $diff = strtotime($today) - strtotime($regDate);
                $outstanding_days = floor($diff / (60 * 60 * 24));
                $isCompliant = false;
            }
        } elseif ($paidUntil < $today) {
            $diff = strtotime($today) - strtotime($paidUntil);
            $outstanding_days = floor($diff / (60 * 60 * 24));
            $isCompliant = false;
        }

        $days_in_month = (int)date('t');
        $current_day = (int)date('d');
        
        // Calculate days paid specifically within the current month based on coverage
        $days_paid_this_month = 0;
        $first_of_month = date('Y-m-01');
        $last_of_month = date('Y-m-t');

        if ($paidUntil) {
            if ($paidUntil >= $last_of_month) {
                $days_paid_this_month = $days_in_month;
            } elseif ($paidUntil >= $first_of_month) {
                $days_paid_this_month = (int)date('d', strtotime($paidUntil));
            }
        }

        $data = [
            'title' => 'Member Dashboard | ' . SITENAME,
            'active_page' => 'dashboard',
            'member' => $member,
            'recent_payments' => array_slice($recent_payments, 0, 5),
            'days_paid' => $days_paid_this_month,
            'total_paid' => $total_paid_this_month,
            'outstanding_days' => $outstanding_days,
            'outstanding_amount' => $outstanding_days * $dailyRate,
            'is_compliant' => $isCompliant,
            'paid_until' => $paidUntil ? date('d M Y', strtotime($paidUntil)) : 'Never',
            'days_in_month' => $days_in_month,
            'current_day' => $current_day,
            'grace_period' => $grace_period
        ];
        
        $this->view('users/index', $data);
    }

    public function profile()
    {
        $member_id = $_SESSION['member_id'];
        $member = $this->memberModel->getMemberById($member_id);

        $data = [
            'title' => 'My Profile | ' . SITENAME,
            'active_page' => 'profile',
            'member' => $member
        ];
        
        $this->view('users/profile', $data);
    }

    public function pay()
    {
        $member_id = $_SESSION['member_id'];
        $member = $this->memberModel->getMemberById($member_id);

        $settingsModel = $this->model('Settings');
        $paystackKey = $settingsModel->getSetting('paystack_public_key');

        $data = [
            'title' => 'Pay My Tax | ' . SITENAME,
            'active_page' => 'pay',
            'member' => $member,
            'paystack_public_key' => $paystackKey
        ];
        
        $this->view('users/pay', $data);
    }

    public function verify_payment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reference = $_POST['reference'] ?? '';
            $amount = $_POST['amount'] ?? 0;
            $tax_type = $_POST['tax_type'] ?? 'daily';
            $member_id = $_SESSION['member_id'];
            $member = $this->memberModel->getMemberById($member_id);

            if (empty($reference)) {
                flash('member_error', 'Invalid payment reference.', 'alert alert-danger');
                redirect('users/pay');
            }

            // Server-side Verify
            $settingsModel = $this->model('Settings');
            $secretKey = $settingsModel->getSetting('paystack_secret_key');

            // Skip verification for simulated test references
            if ($secretKey && strpos($reference, 'TEST_REF_') === false) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => array(
                        "accept: application/json",
                        "authorization: Bearer " . $secretKey,
                        "cache-control: no-cache"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    flash('member_error', 'Verification failed: ' . $err, 'alert alert-danger');
                    redirect('users/pay');
                }

                $tranx = json_decode($response);
                if (!$tranx || !$tranx->status || $tranx->data->status !== 'success') {
                    flash('member_error', 'Transaction verification failed.', 'alert alert-danger');
                    redirect('users/pay');
                }
                
                // Confirm amount matches (Paystack returns amount in kobo)
                if ($tranx->data->amount != ($amount * 100)) {
                    flash('member_error', 'Payment amount mismatch.', 'alert alert-danger');
                    redirect('users/pay');
                }
            } else if (!$secretKey && strpos($reference, 'TEST_REF_') === false) {
                 // No secret key and not a test ref? Alert but proceed if it's local dev
                 // flash('member_warning', 'Payment recorded without verification (missing API key).');
            }
            
            // Record payment
            $paymentData = [
                'member_id' => $member_id,
                'lga_id' => $member->lga_id,
                'unit_id' => $member->unit_id,
                'amount' => $amount,
                'payment_type' => $tax_type,
                'payment_method' => 'paystack',
                'reference' => $reference,
                'status' => 'completed',
                'agent_id' => 0 // System/Self-service
            ];

            $adminModel = $this->model('Admin');
            if ($adminModel->recordPayment($paymentData)) {
                flash('member_success', 'Payment successful and recorded!');
                redirect('users/index');
            } else {
                flash('member_error', 'Failed to record payment.', 'alert alert-danger');
                redirect('users/pay');
            }
        } else {
            redirect('users/pay');
        }
    }

    public function payments()
    {
        $member_id = $_SESSION['member_id'];
        $payments = $this->memberModel->getMemberPayments($member_id);

        $data = [
            'title' => 'Tax Payment History | ' . SITENAME,
            'active_page' => 'payments',
            'payments' => $payments
        ];
        
        $this->view('users/payments', $data);
    }

    public function receipt($id = null)
    {
        if (!$id) {
            redirect('users/payments');
        }

        $adminModel = $this->model('Admin');
        $transaction = $adminModel->getTransactionById($id);

        if (!$transaction || $transaction->member_id != $_SESSION['member_id']) {
            flash('member_error', 'Receipt not found or unauthorized access.', 'alert alert-danger');
            redirect('users/payments');
        }

        $data = [
            'title' => 'Print Receipt | ' . SITENAME,
            'active_page' => 'payments',
            'transaction' => $transaction
        ];
        
        $this->view('users/receipt', $data);
    }

    public function id_card()
    {
        $member_id = $_SESSION['member_id'];
        $member = $this->memberModel->getMemberById($member_id);

        if (!$member) {
            flash('member_error', 'Member not found');
            redirect('users/index');
        }

        $data = [
            'title' => 'Digital ID Card | ' . SITENAME,
            'active_page' => 'id_card',
            'member' => $member
        ];
        
        $this->view('users/id_card', $data);
    }

    public function notifications()
    {
        $data = [
            'title' => 'Member Notifications | ' . SITENAME,
            'active_page' => 'notifications'
        ];
        
        $this->view('users/notifications', $data);
    }

    public function complaints()
    {
        $member_id = $_SESSION['member_id'];
        $complaints = $this->memberModel->getMemberComplaints($member_id);

        $data = [
            'title' => 'Lodge a Complaint | ' . SITENAME,
            'active_page' => 'complaints',
            'complaints' => $complaints
        ];
        
        $this->view('users/complaints', $data);
    }

    public function submit_complaint()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $member_id = $_SESSION['member_id'];
            $member = $this->memberModel->getMemberById($member_id);

            $data = [
                'member_id' => $member_id,
                'lga_id' => $member->lga_id,
                'unit_id' => $member->unit_id,
                'category' => trim($_POST['category'] ?? ''),
                'subject' => trim($_POST['subject'] ?? ''),
                'description' => trim($_POST['description'] ?? '')
            ];

            if (empty($data['category']) || empty($data['subject']) || empty($data['description'])) {
                flash('member_error', 'Please fill out all fields.', 'alert alert-danger');
            } else {
                if ($this->memberModel->createComplaint($data)) {
                    flash('member_success', 'Complaint lodged successfully! We will review it shortly.');
                } else {
                    flash('member_error', 'Failed to lodge complaint. Please try again.', 'alert alert-danger');
                }
            }
        }
        redirect('users/complaints');
    }

    public function sticker()
    {
        $member_id = $_SESSION['member_id'];
        $member = $this->memberModel->getMemberById($member_id);

        if (!$member) {
            flash('member_error', 'Member not found');
            redirect('users/index');
        }

        $expiry = date('d M Y', strtotime($member->created_at . ' + 1 year'));

        $data = [
            'title' => 'Digital Sticker | ' . SITENAME,
            'active_page' => 'sticker',
            'member' => $member,
            'expiry' => $expiry
        ];
        
        $this->view('users/sticker', $data);
    }
}
