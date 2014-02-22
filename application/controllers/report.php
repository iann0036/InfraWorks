<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
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
        $users = $this->my_users->getUsers();
        for ($i=0; $i<count($users); $i++) {
            $users[$i]['assets'] = $this->my_assets->getAssets($users[$i]['username']);
            for ($j=0; $j<count($users[$i]['assets']); $j++) {
                $users[$i]['assets'][$j]['fields'] = $this->my_assets->getFields($users[$i]['assets'][$j]['product_id']);
                $users[$i]['assets'][$j]['field_values'] = $this->my_assets->getFieldValues($users[$i]['assets'][$j]['id']);
            }
        }

        $data = array(
            'report' => $users
        );

        $this->load->view('header',array(
            'page' => 'report',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
		$this->load->view('report',$data);
        $this->load->view('footer');
	}
}