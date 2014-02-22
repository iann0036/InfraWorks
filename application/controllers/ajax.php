<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('my_users');
        $this->load->model('my_assets');
        $this->load->library('session');
        $this->load->helper('url');
        if (!$this->session->userdata('username'))
            redirect('/login/');
    }

    public function getFields($id) {
        $fields = $this->my_assets->getFields($id);
        echo json_encode($fields);
    }
}