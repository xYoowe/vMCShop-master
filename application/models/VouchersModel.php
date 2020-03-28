<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 14.08.2017 00:49.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class VouchersModel extends CI_Model {

    private $table = "vmcs_vouchers";

    public function getAll() {
        return $this->db->order_by('id')->get($this->table)->result_array();
    }

    public function getByID($id) {
        return $this->db->where('id', $id)->get($this->table)->row_array();
    }

    public function getByCode($code) {
        return $this->db->where('code', $code)->get($this->table)->row_array();
    }

    public function addMultiple($data) {
        return $this->db->insert_batch($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
    
}