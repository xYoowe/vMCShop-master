<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 08.10.2017 15:17.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class PagesModel extends CI_Model {

    private $table = "vmcs_pages";

    public function getAll() {
        return $this->db->order_by('id')->get($this->table)->result_array();
    }

    public function getBy($column, $data) {
        return $this->db->where($column, $data)->get($this->table)->result_array();
    }

    public function add($data) {
        return $this->db->insert($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    public function update($data, $id) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }
    
}