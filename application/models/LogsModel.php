<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 14.08.2017 16:03.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class LogsModel extends CI_Model {

    public $table = "vmcs_logs";

    public function getAll() {
        return $this->db->order_by('id', 'desc')->get($this->table)->result_array();
    }

    public function getBySection($section) {
        return $this->db->where('section', $section)->order_by('id', 'desc')->limit(5)->get($this->table)->result_array();
    }

    public function add($data) {
        return $this->db->insert($this->table, $data);
    }
}