<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;
use xPaw\SourceQuery\SourceQuery;

/**
 * Created with ♥ by Verlikylos on 02.05.2017 23:38.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
	
		$this->benchmark->mark('code_start');
    	
    	/**  Head Section  */
    	
    	$header_data['page_title'] = $this->config->item('page_title') . " | Strona Główna";
    	
		$this->load->view('components/Header', $header_data);
	
		
		/**  Body Section  */
    
        require_once(APPPATH.'libraries/MinecraftPing.php');
        require_once(APPPATH.'libraries/MinecraftPingException.php');
		$this->load->model('ServersModel');
		$this->load->model('NewsModel');
		$this->load->model('PurchasesModel');
		$this->load->model('ServicesModel');
		$this->load->model('PagesModel');

		$this->load->helper('date');

        $bodyData['news'] = $this->NewsModel->getAll();
		$servers = $this->ServersModel->getAll();
        $bodyData['servers'] = array();
        $purchases = $this->PurchasesModel->getLimit(54);
        $purchasesAfterServer = array();
        $bodyData['purchases'] = array();
        $services = $this->ServicesModel->getAll();
        $bodyData['pages'] = $this->PagesModel->getAll();

        foreach ($servers as $server) {

            foreach ($purchases as $purchase) {
                if ($purchase['server'] == $server['id']) {
                    $purchase['server'] = $server['name'];
                    array_push($purchasesAfterServer, $purchase);
                }
            }
    
            try {
                $Query = new MinecraftPing($server['ip'], $server['query_port']);
                $result = $Query->Query();
                $server['status']['Players'] = $result['players']['online'];
                $server['status']['MaxPlayers'] = $result['players']['max'];
            } catch (MinecraftPingException $e) {
                try {
                    $Query = new MinecraftPing($server['ip'], $server['query_port']);
                    $result = $Query->QueryOldPre17();
                    $server['status']['Players'] = $result['players']['online'];
                    $server['status']['MaxPlayers'] = $result['players']['max'];
                } catch (MinecraftPingException $e) {
                    // echo $e->getMessage();
                }
            }

            array_push($bodyData['servers'], $server);
        }

        foreach ($services as $service) {

            foreach ($purchasesAfterServer as $purchase) {
                if ($purchase['service'] == $service['id']) {
                    $purchase['service'] = $service['name'];
                    array_push($bodyData['purchases'], $purchase);
                }
            }

        }

        $this->load->view('Home', $bodyData);
	
        
		/**  Footer Section  */
	
	
		$this->benchmark->mark('code_end');
	
		$footer_data['benchmark'] = $this->benchmark->elapsed_time('code_start', 'code_end');
		
		$this->load->view('components/Footer', $footer_data);
		
    }
}