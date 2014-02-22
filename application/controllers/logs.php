<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('my_logs');
        $this->load->model('my_users');
        $this->load->model('my_assets');

        $this->load->library('session');
        $this->load->helper('url');
        if (!$this->session->userdata('username'))
            redirect('/login/');
    }

	public function index()
	{
        $data = array(
            'logs' => $this->my_logs->getLogs()
        );

        $this->load->view('header',array(
            'page' => 'logs',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
        $this->load->view('logs',$data);
        $this->load->view('footer');
	}
}