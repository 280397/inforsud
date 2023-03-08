<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_admin_1();
        // check_not_login();
        $this->load->model('User_model');

        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('frontend/index');
    }

    public function login()
    {
        redirect('Auth');
    }
}
