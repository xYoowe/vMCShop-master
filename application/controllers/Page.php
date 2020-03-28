<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 08.10.2017 17:49.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Page extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($pageId = null) {

        $this->benchmark->mark('code_start');

        $this->load->model('PagesModel');

        if (($pageId == null) || (!$page = $this->PagesModel->getBy('id', $pageId)) || ($page[0]['active'] != 1)) {

            $this->load->view('errors/html/error_404');

        } else {


            /**  Head Section  */

            $headerData['page_title'] = $this->config->item('page_title') . " | " . $page[0]['title'];

            $this->load->view('components/Header', $headerData);


            /**  Body Section  */

            $this->load->model('ServersModel');

            $bodyData['page'] = $page[0];
            $bodyData['servers'] = $this->ServersModel->getAll();
            $bodyData['pages'] = $this->PagesModel->getAll();

            $this->load->view('Page', $bodyData);


            /**  Footer Section  */

            $this->benchmark->mark('code_end');

            $footerData['benchmark'] = $this->benchmark->elapsed_time('code_start', 'code_end');

            $this->load->view('components/Footer', $footerData);


        }
    }

}