<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_assets extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database('default');
        $this->load->model('my_users');
    }

    public function addAsset($username,$product,$barcode,$notes,$inputs) {
        if ($this->my_users->getUserType($username)=='ldap') {
            $this->my_users->addUserToDatabase($username);
        }

        $insert_data = array(
            'username' => $username,
            'product_id' => $product,
            'barcode' => $barcode,
            'notes' => $notes
        );
        $this->db->insert('assets',$insert_data);
        $asset_id = $this->db->insert_id();

        foreach ($inputs as $input) {
            $insert_data = array(
                'asset_id' => $asset_id,
                'field_id' => $input['id'],
                'value' => $input['value']
            );
            $this->db->insert('asset_fields',$insert_data);
        }

        return $asset_id;
    }

    public function modifyAsset($id,$username,$product,$barcode,$notes,$inputs) {
        if ($this->my_users->getUserType($username)=='ldap') {
            $this->my_users->addUserToDatabase($username);
        }

        $update_data = array(
            'username' => $username,
            'product_id' => $product,
            'barcode' => $barcode,
            'notes' => $notes
        );
        $this->db->where('id',$id);
        $this->db->update('assets',$update_data);
        $asset_id = $id;

        $this->db->where('asset_id',$asset_id);
        $this->db->delete('asset_fields');
        foreach ($inputs as $input) {
            $insert_data = array(
                'asset_id' => $asset_id,
                'field_id' => $input['id'],
                'value' => $input['value']
            );
            $this->db->insert('asset_fields',$insert_data);
        }

        return $asset_id;
    }

    public function reassignAsset($id,$username) {
        $update_data = array(
            'username' => $username
        );

        $this->db->where('id',$id);
        $this->db->update('assets',$update_data);
    }

    public function getAsset($id) {
        $this->db->where('id',$id);
        $result = $this->db->get('assets');
        foreach ($result->result_array() as $row) { // TODO dirty code
            return array(
                'id' => $row['id'],
                'username' => $row['username'],
                'product_id' => $row['product_id'],
                'name' => $this->getProductNameByProductId($row['product_id']),
                'barcode' => $row['barcode'],
                'notes' => $row['notes']
            );
        }

        return null;
    }

    public function getProductNameByProductId($id) {
        $this->db->where('id',$id);
        $result = $this->db->get('products');

        foreach ($result->result_array() as $row) { // TODO dirty code
            return $row['name'];
        }

        return null;
    }

    public function getFieldValues($id) {
        $values = array();

        $this->db->where('asset_id',$id);
        $result = $this->db->get('asset_fields');
        foreach ($result->result_array() as $row) {
            $values[$row['field_id']] = $row['value'];
        }

        return $values;
    }

    public function getAssetsByProductId($product_id) {
        $assets = array();

        $this->db->where('product_id',$product_id);
        $result = $this->db->get('assets');
        foreach ($result->result_array() as $row) {
            $assets[] = array(
                'id' => $row['id'],
                'product_id' => $row['product_id'],
                'username' => $row['username'],
                'user_name' => $this->my_users->getNameByUsername($row['username']),
                'name' => $this->getProductNameByProductId($row['product_id']),
                'barcode' => $row['barcode'],
                'notes' => $row['notes']
            );
        }

        return $assets;
    }

    public function getAssetCount($user) {
        return count($this->getAssets($user));
    }

    public function getAssets($user) {
        $assets = array();

        $this->db->where('username',$user);
        $result = $this->db->get('assets');
        foreach ($result->result_array() as $row) {
            $assets[] = array(
                'id' => $row['id'],
                'product_id' => $row['product_id'],
                'name' => $this->getProductNameByProductId($row['product_id']),
                'barcode' => $row['barcode'],
                'notes' => $row['notes']
            );
        }

        return $assets;
    }

    public function clearFields($id) {
        $this->db->where('product_id',$id);
        $this->db->delete('fields');
    }

    public function clearField($id) {
        $this->db->where('id',$id);
        $this->db->delete('fields');
    }

    public function getFields($id) {
        $fields = array();

        $this->db->where('product_id',$id);
        $result = $this->db->get('fields');
        foreach ($result->result_array() as $row) {
            $fields[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'type' => $row['type'],
                'options' => $row['options']
            );
        }

        return $fields;
    }

    public function addField($id,$name,$type,$options) {
        if ($name!=null) {
            $insert_data = array(
                'product_id' => $id,
                'name' => $name,
                'type' => $type,
                'options' => $options
            );
            $this->db->insert('fields',$insert_data);
        }
    }

    public function getProducts() {
        $products = array();

        $result = $this->db->get('products');
        foreach ($result->result_array() as $row) {
            $this->db->where('product_id',$row['id']);
            $result2 = $this->db->get('assets');
            $product_count = $result2->num_rows();
            $products[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'count' => $product_count
            );
        }

        return $products;
    }

    public function count() {
        return $this->db->count_all('assets');
    }

    public function addProduct($name,$description) {
        $insert_data = array(
            'name' => $name,
            'description' => $description
        );

        $this->db->insert('products',$insert_data);
        return $this->db->insert_id();
    }

    public function remove($id) {
        $this->db->where('id',$id);
        $this->db->delete('assets');

        $this->db->where('asset_id',$id);
        $this->db->delete('asset_fields');
    }

    public function removeProduct($id) {
        $this->db->where('id',$id);
        $this->db->delete('products');
    }

    public function lookup($barcode) {
        $this->db->where('barcode',$barcode);
        $result = $this->db->get('assets');
        if ($result->num_rows() > 0) {
            $row = $result->row_array();
            return $row['id'];
        } else
            return null;
    }
}