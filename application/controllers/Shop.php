<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 03.05.2017 14:54.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Shop extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
	
	public function index($serverName = null) {

        $this->benchmark->mark('code_start');

        $this->load->model('ServersModel');

        if (($serverName == null) || (!$server = $this->ServersModel->getByName($serverName))) {

            $this->load->view('errors/html/error_404');

        } else {

            /**  Head Section  */

            $header_data['page_title'] = $this->config->item('page_title') . " | Sklep Serwera " . $server['name'];

            $this->load->view('components/Header', $header_data);


            /**  Body Section  */

            $this->load->library('form_validation');
            $this->load->model('ServersModel');
            $this->load->model('ServicesModel');
            $this->load->model('PagesModel');
            $this->load->helper('smsnumbers_helper');

            $bodyData['servers'] = $this->ServersModel->getAll();
            $bodyData['services'] = $this->ServicesModel->getForServer($server['id']);
            $bodyData['server'] = $server;
            $bodyData['smsOperator'] = $this->config->item('sms_operator');
            $bodyData['pages'] = $this->PagesModel->getAll();

            $this->load->view('Shop', $bodyData);


            /**  Footer Section  */


            $this->benchmark->mark('code_end');

            $footer_data['benchmark'] = $this->benchmark->elapsed_time('code_start', 'code_end');

            $this->load->view('components/Footer', $footer_data);

        }
		
	}
}