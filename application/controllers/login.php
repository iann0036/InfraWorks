<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('my_users');
        $this->load->model('my_logs');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        if ($this->input->get_post('username')) {
            if ($this->my_users->auth($this->input->get_post('username'),$this->input->get_post('password'))) {
                $this->my_logs->log($this->input->get_post('username').' logged in');
                redirect('/');
            } else
                $this->load->view('login',array('failure' => true));
        } else
            $this->load->view('login');
    }
}