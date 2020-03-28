<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 14.08.2017 16:05.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Logs extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {

        if (!$this->session->userdata('logged')) redirect(base_url());

        /**  Head Section  */

        $header_data['page_title'] = $this->config->item('page_title') . " | Logi";

        $this->load->view('panel/components/Header', $header_data);


        /**  Body Section  */

        $this->load->model('LogsModel');
        $this->load->helper('date_helper');

        $bodyData['logs'] = $this->LogsModel->getAll();

        $this->load->view('panel/Logs', $bodyData);


        /**  Footer Section  */

        $this->load->view('panel/components/Footer');

    }
}