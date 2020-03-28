<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 04.07.2017 13:17.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class ServersModel extends CI_Model {

    public $table = "vmcs_servers";

    public function getAll() {
        return $this->db->order_by('id')->get($this->table)->result_array();
    }

    public function getByID($id) {
        return $this->db->where('id', $id)->get($this->table)->row_array();
    }

    public function getByName($name) {
        return $this->db->where('name', $name)->get($this->table)->row_array();
    }

    public function count() {
        return $this->db->count_all($this->table);
    }

    public function add($data) {
        return $this->db->insert($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
}