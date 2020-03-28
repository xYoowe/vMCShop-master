<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 14.08.2017 01:54.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Settings extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {

        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->view('errors/html/error_404');

        /**  Head Section  */

        /**$this->load->library('form_validation');

        $header_data['page_title'] = $this->config->item('page_title') . " | Ustawienia strony";

        $this->config->load('settings');

        $this->load->view('panel/components/Header', $header_data);*/


        /**  Body Section  */

        //$this->load->view('panel/Settings');


        /**  Footer Section  */

        //$this->load->view('panel/components/Footer');

    }

    public function save() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->view('errors/html/error_404');


        /**$this->load->library('form_validation');

        $this->form_validation->set_rules('pageTitle', 'pageTitle', 'required|trim');
        $this->form_validation->set_rules('pageDescription', 'pageDescription', 'trim');
        $this->form_validation->set_rules('pageTags', 'pageTags', 'trim');
        $this->form_validation->set_rules('pageFavicon', 'pageFavicon', 'trim');
        $this->form_validation->set_rules('pageHeaderImage', 'pageHeaderImage', 'required|trim');
        $this->form_validation->set_rules('pageHeaderTitle', 'pageHeaderTitle', 'required|trim');
        $this->form_validation->set_rules('pageHeaderSubtitle', 'pageHeaderSubtitle', 'trim');
        $this->form_validation->set_rules('voucherPrefix', 'voucherPrefix', 'trim');
        $this->form_validation->set_rules('voucherLenght', 'voucherLenght', 'required|trim');
        $this->form_validation->set_rules('smsOperator', 'smsOperator', 'required|trim');
        $this->form_validation->set_rules('microsmsUserid', 'microsmsUserid', 'trim');

        if ($this->form_validation->run() === TRUE) {
            $this->config->load('settings', TRUE);


            $_SESSION['messageSuccess'] = "Ustawienia strony zostały pomyślnie zapisane!";
            echo $this->config->item('page_title');
        } else {
            $_SESSION['messageDanger'] = "Proszę wypełnić wymagane pola formularza!";
            redirect(base_url('panel/settings'));
        }*/
    }
}