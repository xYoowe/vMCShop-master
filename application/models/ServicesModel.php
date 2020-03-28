<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 04.07.2017 13:17.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class ServicesModel extends CI_Model {

    public $table = "vmcs_services";

    public function getAll() {
        return $this->db->get($this->table)->result_array();
    }

    public function getByID($id) {
        return $this->db->where('id', $id)->get($this->table)->row_array();
    }

    public function getForServer($id) {
        return $this->db->where('server', $id)->order_by('id')->get($this->table)->result_array();
    }

    public function add($data) {
        return $this->db->insert($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

}