<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('my_users');
        $this->load->model('my_assets');
        $this->load->model('my_logs');
        $this->load->library('session');
        $this->load->helper('url');
        if (!$this->session->userdata('username'))
            redirect('/login/');
    }

	public function index()
	{
        $this->load->view('header',array(
            'page' => 'dashboard',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
		$this->load->view('dashboard');
        $this->load->view('footer');
	}
}