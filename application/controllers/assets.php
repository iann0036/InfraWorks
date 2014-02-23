<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assets extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('my_users');
        $this->load->model('my_assets');
        $this->load->model('my_logs');
        $this->load->library('session');
        $this->load->helper('url');
        if (!$this->session->userdata('username'))
            redirect('/login/');;
    }

	/*public function index()
	{
        $data = array(
            'products' => $this->my_assets->getProducts()
        );

        $this->load->view('header',array(
            'page' => 'products',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count()
        ));
		$this->load->view('products',$data);
        $this->load->view('footer');
	}*/

    public function modifyasset() {
        $fields = array();

        foreach ($_POST as $key => $value) {
            if (substr($key,0,5)=='field') {
                $fields[] = array(
                    'id' => substr($key,6),
                    'value' => $value
                );
            }
        }
        $asset_id = $this->my_assets->modifyAsset($this->input->get_post('id'),$this->input->get_post('username'),$this->input->get_post('product'),$this->input->get_post('barcode'),$this->input->get_post('notes'),$fields);

        $this->my_logs->log('Modified asset '.$asset_id.' with properties; ',$this->input->get_post('username'),$this->input->get_post('product'),$this->input->get_post('barcode'),$this->input->get_post('notes'),$fields);
        redirect('/assets/view/'.$asset_id);
    }

    public function remove($id) {
        $this->my_assets->remove($id);
        $this->my_logs->log('Deleted asset '.$id);
        redirect('/products/');
    }

    public function modify($id) {
        $asset = $this->my_assets->getAsset($id);
        $data = array(
            'id' => $id,
            'username' => $asset['username'],
            'user_name' => $this->my_users->getNameByUsername($asset['username']),
            'product_id' => $asset['product_id'],
            'barcode' => $asset['barcode'],
            'name' => $asset['name'],
            'notes' => $asset['notes'],
            'fields' => $this->my_assets->getFields($asset['product_id']),
            'field_values' => $this->my_assets->getFieldValues($id),
            'users' => $this->my_users->getUsers(),
            'products' => $this->my_assets->getProducts()
        );

        $this->load->view('header',array(
            'page' => 'Modify Asset',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
        $this->load->view('assets_modify',$data);
        $this->load->view('footer');
    }

    public function lookup() {
        $barcode = $this->input->get_post('barcode');

        $asset_id = $this->my_assets->lookup($barcode);
        if ($asset_id!=null) {
            redirect('/assets/view/'.$asset_id);
        } else
            redirect('/assets/add/'.$barcode);
    }

    public function add($barcode = null) {
        $data = array(
            'barcode' => $barcode,
            'users' => $this->my_users->getUsers(),
            'products' => $this->my_assets->getProducts()
        );

        $this->load->view('header',array(
            'page' => 'Add Asset',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
        $this->load->view('assets_add',$data);
        $this->load->view('footer');
    }

    public function addAsset() {
        $fields = array();

        foreach ($_POST as $key => $value) {
            if (substr($key,0,5)=='field') {
                $fields[] = array(
                    'id' => substr($key,6),
                    'value' => $value
                );
            }
        }
        $asset_id = $this->my_assets->addAsset($this->input->get_post('username'),$this->input->get_post('product'),$this->input->get_post('barcode'),$this->input->get_post('notes'),$fields);

        $this->my_logs->log('Added asset '.$asset_id.' with properties; ',$this->input->get_post('username'),$this->input->get_post('product'),$this->input->get_post('barcode'),$this->input->get_post('notes'),$fields);
        redirect('/assets/view/'.$asset_id);
    }

    public function doreassign() {
        $asset_id = $this->input->get_post('id');
        $new_username = $this->input->get_post('username');

        $update_data = array(
            'username' => $new_username
        );
        $this->db->where('id',$asset_id);
        $this->db->update('assets',$update_data);

        redirect('/assets/view/'.$asset_id);
    }

    public function reassign($id) {
        $asset = $this->my_assets->getAsset($id);
        $data = array(
            'id' => $id,
            'username' => $asset['username'],
            'user_name' => $this->my_users->getNameByUsername($asset['username']),
            'product_id' => $asset['product_id'],
            'barcode' => $asset['barcode'],
            'name' => $asset['name'],
            'notes' => $asset['notes'],
            'fields' => $this->my_assets->getFields($asset['product_id']),
            'field_values' => $this->my_assets->getFieldValues($id),
            'users' => $this->my_users->getUsers()
        );

        $this->load->view('header',array(
            'page' => 'Assets Reassign',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
        $this->load->view('assets_reassign',$data);
        $this->load->view('footer');
    }


    public function view($id) {
        $asset = $this->my_assets->getAsset($id);
        $data = array(
            'id' => $id,
            'username' => $asset['username'],
            'user_name' => $this->my_users->getNameByUsername($asset['username']),
            'product_id' => $asset['product_id'],
            'barcode' => $asset['barcode'],
            'name' => $asset['name'],
            'notes' => $asset['notes'],
            'fields' => $this->my_assets->getFields($asset['product_id']),
            'field_values' => $this->my_assets->getFieldValues($id)
        );

        $this->load->view('header',array(
            'page' => 'Asset View',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
        $this->load->view('assets_view',$data);
        $this->load->view('footer');
    }
}