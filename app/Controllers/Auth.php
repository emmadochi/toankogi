<?php

namespace App\Controllers;

use App\Core\Controller;

class Auth extends Controller
{
    private $memberModel;

    public function __construct()
    {
        $this->memberModel = $this->model('Member');
    }

    public function login()
    {
        // Redirect if already logged in
        if (isMemberLoggedIn()) {
            redirect('users/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Member Login | ' . SITENAME,
                'identifier' => trim($_POST['identifier']),
                'password' => trim($_POST['password']),
                'identifier_err' => '',
                'password_err' => '',
            ];

            if (empty($data['identifier'])) {
                $data['identifier_err'] = 'Please enter your Unique ID or Plate Number';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter your password';
            }

            if (empty($data['identifier_err']) && empty($data['password_err'])) {
                $loggedInMember = $this->memberModel->login($data['identifier'], $data['password']);

                if ($loggedInMember) {
                    $this->createMemberSession($loggedInMember, $data['password']);
                } else {
                    $data['password_err'] = 'Password incorrect or member not found';
                    $this->view('auth/login', $data);
                }
            } else {
                $this->view('auth/login', $data);
            }
        } else {
            $data = [
                'title' => 'Member Login | ' . SITENAME,
                'identifier' => '',
                'password' => '',
                'identifier_err' => '',
                'password_err' => '',
            ];
            $this->view('auth/login', $data);
        }
    }

    public function createMemberSession($member, $plain_password = null)
    {
        $_SESSION['member_id'] = $member->id;
        $_SESSION['member_unique_id'] = $member->unique_id;
        $_SESSION['member_fullname'] = $member->fullname;
        $_SESSION['member_lga_id'] = $member->lga_id;
        $_SESSION['member_lga_name'] = $member->lga_name;
        $_SESSION['member_unit_id'] = $member->unit_id;
        $_SESSION['member_unit_name'] = $member->unit_name;
        $_SESSION['member_plate_number'] = $member->plate_number;
        
        // Check if user is still on default password
        if ($member->is_default_password == 1) {
            $_SESSION['force_password_change'] = true;
        } else {
            $_SESSION['force_password_change'] = false;
        }

        session_write_close();
        redirect('users/index');
    }

    public function logout()
    {
        unset($_SESSION['member_id']);
        unset($_SESSION['member_unique_id']);
        unset($_SESSION['member_fullname']);
        unset($_SESSION['member_lga_id']);
        unset($_SESSION['member_lga_name']);
        unset($_SESSION['member_unit_id']);
        unset($_SESSION['member_unit_name']);
        unset($_SESSION['member_plate_number']);
        
        flash('member_login_success', 'You have successfully logged out');
        redirect('auth/login');
    }
}
