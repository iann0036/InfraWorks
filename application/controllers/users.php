<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
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
            $users[$i]['assetcount'] = $this->my_assets->getAssetCount($users[$i]['username']);
        }

        $data = array();
        $data['users'] = $users;

        $this->load->view('header',array(
            'page' => 'users',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
		$this->load->view('users',$data);
        $this->load->view('footer');
	}

    public function view($username) {
        $user = $this->my_users->getUser($username);
        $assets = $this->my_assets->getAssets($username);

        $data = array();
        $data['user'] = $user;
        $data['assets'] = $assets;

        $this->load->view('header',array(
            'page' => 'users',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
        $this->load->view('users_view',$data);
        $this->load->view('footer');
    }
}