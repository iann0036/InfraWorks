<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_logs extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database('default');
        $this->load->library('session');
    }

    public function log($message) {
        $insert_data = array(
            'username' => $this->session->userdata('username'),
            'message' => $message
        );

        $this->db->insert('logs',$insert_data);
    }

    public function getLogs() {
        $logs = array();

        $result = $this->db->get('logs');
        foreach ($result->result_array() as $row) {
            $logs[] = $row;
        }

        return $logs;
    }
}