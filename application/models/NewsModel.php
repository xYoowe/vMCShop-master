<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 09.07.2017 20:44.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class NewsModel extends CI_Model {

    public $table = "vmcs_news";

    public function getByID($id) {
        return $this->db->where('id', $id)->get($this->table)->row_array();
    }

    public function getAll() {
        return $this->db->order_by('date', 'desc')->get($this->table)->result_array();
    }

    public function add($data) {
        return $this->db->insert($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
    
}