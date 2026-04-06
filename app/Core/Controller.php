<?php

namespace App\Core;

class Controller
{
    public function model($model)
    {
        $modelClass = "App\\Models\\" . $model;
        return new $modelClass;
    }

    public function view($view, $data = [])
    {
        // Extract data to make it available in the view
        extract($data);
        
        $viewFile = APPROOT . '/Views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View does not exist.");
        }
    }

    /**
     * Ensure the user is authenticated
     *
     * @return void
     */
    protected function requireAuth() {
        if (!isLoggedIn()) {
            flash('admin_login_error', 'Please log in to access this area', 'alert alert-danger');
            redirect('admin/login');
        }
    }

    /**
     * Ensure the member is authenticated
     *
     * @return void
     */
    protected function requireMemberAuth() {
        if (!isMemberLoggedIn()) {
            flash('member_login_error', 'Please log in to access your dashboard', 'alert alert-danger');
            redirect('auth/login');
        }
    }

    /**
     * Ensure the user has the required role
     *
     * @param array $roles
     * @return void
     */
    protected function requireRole($roles) {
        // First ensure they are logged in
        $this->requireAuth();

        if (!in_array($_SESSION['user_role'], $roles)) {
            flash('admin_access_error', 'You do not have permission to access that area', 'alert alert-danger');
            redirect('admin/index');
        }
    }
}
