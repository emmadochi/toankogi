<?php

namespace App\Controllers;

use App\Core\Controller;

class Agent extends Controller
{
    private $adminModel;

    public function __construct()
    {
        // Check for login
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }

        // Check for Agent role (or higher for testing)
        if ($_SESSION['user_role'] !== 'agent' && $_SESSION['user_role'] !== 'superadmin' && $_SESSION['user_role'] !== 'lga_admin' && $_SESSION['user_role'] !== 'unit_admin') {
            header('Location: ' . URLROOT . '/admin/index');
            exit;
        }

        $this->adminModel = $this->model('Admin');
    }

    /**
     * Agent Dashboard (Mobile First)
     */
    public function index()
    {
        // Get agent summary stats
        $stats = $this->adminModel->getScopedDashboardStats($_SESSION['user_role'], $_SESSION['user_lga_id'], $_SESSION['user_unit_id'], $_SESSION['user_id']);
        
        // Get recent history for dashboard
        $history = $this->adminModel->getScopedRevenue($_SESSION['user_role'], $_SESSION['user_lga_id'], $_SESSION['user_unit_id'], $_SESSION['user_id']);


        $data = [
            'title' => 'Agent Dashboard',
            'stats' => $stats,
            'history' => $history,
            'user' => [
                'fullname' => $_SESSION['user_fullname'],
                'role' => $_SESSION['user_role'],
                'unit' => $_SESSION['user_unit_name'] ?? 'Unassigned'
            ]
        ];

        $this->view('agent/index', $data);
    }

    /**
     * Plate Number Search / Verification
     */
    public function verify()
    {
        $plate = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $plate = trim($_POST['plate_number'] ?? '');
        } else {
            $plate = $_GET['plate'] ?? '';
        }

        $member = null;
        $error = '';

        if (!empty($plate)) {
            $member = $this->adminModel->getMemberByPlate($plate);
            if (!$member) {
                $error = 'No operator found with plate number: ' . htmlspecialchars($plate);
            }
        }

        $data = [
            'title' => 'Verify Operator',
            'plate' => $plate,
            'member' => $member,
            'error' => $error
        ];

        $this->view('agent/verify', $data);
    }

    /**
     * Collection Form
     */
    public function collect($id)
    {
        $member = $this->adminModel->getMemberById($id);

        if (!$member) {
            flash('agent_message', 'Operator not found', 'alert alert-danger');
            header('Location: ' . URLROOT . '/agent/verify');
            exit;
        }

        // Process Payment (Store with reference)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $paystack_ref = trim($_POST['paystack_reference'] ?? '');

            if (empty($paystack_ref)) {
                flash('agent_message', 'Payment verification failed. No Paystack reference found.', 'alert alert-danger');
                header('Location: ' . URLROOT . '/agent/collect/' . $id);
                exit;
            }

            $paymentData = [
                'member_id' => $id,
                'amount' => $_POST['amount'] ?? 200,
                'payment_type' => $_POST['payment_type'] ?? 'daily',
                'method' => 'online',
                'reference' => $paystack_ref,
                'agent_id' => $_SESSION['user_id']
            ];

            $tx_id = $this->adminModel->recordPayment($paymentData);

            if ($tx_id) {
                header('Location: ' . URLROOT . '/agent/receipt/' . $tx_id);
                exit;
            } else {
                die('Something went wrong recording the payment.');
            }
        }

        $settingsModel = $this->model('Settings');
        $paystackKey = $settingsModel->getSetting('paystack_public_key');

        $data = [
            'title' => 'Collect Payment',
            'member' => $member,
            'paystack_public_key' => $paystackKey
        ];

        $this->view('agent/collect', $data);
    }

    /**
     * Digital Receipt
     */
    public function receipt($id)
    {
        $transaction = $this->adminModel->getTransactionById($id);

        if (!$transaction) {
            flash('agent_message', 'Transaction not found', 'alert alert-danger');
            header('Location: ' . URLROOT . '/agent/index');
            exit;
        }

        $data = [
            'title' => 'Digital Receipt',
            'tx' => $transaction
        ];

        $this->view('agent/receipt', $data);
    }

    /**
     * Today's Collection History
     */
    public function history()
    {
        // This could be restricted to just today's payments for this agent
        $history = $this->adminModel->getScopedRevenue($_SESSION['user_role'], $_SESSION['user_lga_id'], $_SESSION['user_unit_id'], $_SESSION['user_id']);


        $data = [
            'title' => 'Collection History',
            'history' => $history
        ];

        $this->view('agent/history', $data);
    }
}
