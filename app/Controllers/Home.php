<?php

namespace App\Controllers;

use App\Core\Controller;

class Home extends Controller
{
    public function index()
    {
        $data = [
            'title' => SITENAME
        ];
        
        $this->view('home/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us | ' . SITENAME
        ];
        
        $this->view('home/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us | ' . SITENAME
        ];
        
        $this->view('home/contact', $data);
    }

    public function downloads()
    {
        $data = [
            'title' => 'Member Resources | ' . SITENAME
        ];
        
        $this->view('home/downloads', $data);
    }
}
