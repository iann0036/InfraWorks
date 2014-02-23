<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
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

    public function remove($id) {
        $this->my_assets->removeProduct($id);
        $this->my_logs->log('Deleted product '.$id);
        redirect('/products/');
    }

	public function index()
	{
        $data = array(
            'products' => $this->my_assets->getProducts()
        );

        $this->load->view('header',array(
            'page' => 'products',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
		$this->load->view('products',$data);
        $this->load->view('footer');
	}

    public function add() {
        $name = $this->input->get_post('name');
        $description = $this->input->get_post('description');

        $insert_id = $this->my_assets->addProduct($name,$description);

        $this->my_logs->log('Added product '.$insert_id.' with properties: ',$name,$description);

        redirect('/products/modify/'.$insert_id);
    }

    public function modify($id) {
        $data = array(
            'id' => $id,
            'fields' => $this->my_assets->getFields($id)
        );

        $this->load->view('header',array(
            'page' => 'products',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
        $this->load->view('products_modify',$data);
        $this->load->view('footer');
    }

    public function fields() {
        $product_id = $this->input->get_post('id');
        $fieldstring = json_decode($this->input->get_post('fieldstring'),true);

        $original_fields = $this->my_assets->getFields($product_id);

        foreach($fieldstring as $field) {
            $skip = false;
            for ($i=0; $i<count($original_fields); $i++) { // iterate through existing
                if ($field[0]==$original_fields[$i]['name']) {
                    unset($original_fields[$i]);
                    $original_fields = array_values($original_fields); //rekey index
                    $skip = true;
                    break;
                }
            }
            if (!$skip)
                $this->my_assets->addField($product_id,$field[0],$field[1],$field[2]);
        }

        foreach ($original_fields as $field) // remove not matched
            $this->my_assets->clearField($field['id']);

        $this->my_logs->log('Modified product '.$this->input->get_post('id').' to have fields: ',$fieldstring);

        redirect('/products/view/'.$product_id);
    }

    public function view($id) {
        $data = array(
            'id' => $id,
            'name' => $this->my_assets->getProductNameByProductId($id),
            'fields' => $this->my_assets->getFields($id),
            'assets' => $this->my_assets->getAssetsByProductId($id)
        );

        $this->load->view('header',array(
            'page' => 'products',
            'users' => $this->my_users->count(),
            'assets' => $this->my_assets->count(),
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name')
        ));
        $this->load->view('products_view',$data);
        $this->load->view('footer');
    }
}