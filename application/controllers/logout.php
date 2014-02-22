<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('my_logs');
        $this->load->helper('url');

        $this->my_logs->log('Logging out');

        $this->session->sess_destroy();
        redirect('/login/');
    }

    public function index() {

    }
}