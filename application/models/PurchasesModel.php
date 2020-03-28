<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 09.07.2017 21:43.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class PurchasesModel extends CI_Model {

    public $table = "vmcs_purchases";

    public function getAll() {
        return $this->db->order_by('date', 'desc')->get($this->table)->result_array();
    }

    public function getLimit($limit) {
        return $this->db->order_by('date', 'desc')->limit($limit)->get($this->table)->result_array();
    }

    public function count() {
        return $this->db->count_all($this->table);
    }

    public function getForServerLimit($serverId, $limit) {
        return $this->db->where('server', $serverId)->order_by('date', 'desc')->limit($limit)->get($this->table)->result_array();
    }

    public function add($data) {
        return $this->db->insert($this->table, $data);
    }
}