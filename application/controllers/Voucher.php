<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

/**
 * Created with ♥ by Verlikylos on 14.08.2017 17:19.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Voucher extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->benchmark->mark('code_start');

        $this->load->library('form_validation');

        /**  Head Section  */

        $header_data['page_title'] = $this->config->item('page_title') . " | Realizacja vouchera";

        $this->load->view('components/Header', $header_data);


        /**  Body Section  */

        $this->load->model('ServersModel');
        $this->load->model('PagesModel');
        
        $bodyData['servers'] = $this->ServersModel->getAll();
        $bodyData['pages'] = $this->PagesModel->getAll();
        
        $this->load->view('Voucher', $bodyData);


        /**  Footer Section  */


        $this->benchmark->mark('code_end');

        $footer_data['benchmark'] = $this->benchmark->elapsed_time('code_start', 'code_end');

        $this->load->view('components/Footer', $footer_data);

    }

    public function redeem() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('voucher', 'voucher', 'required|trim');
        $this->form_validation->set_rules('userName', 'userName', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $voucherCode = $this->input->post('voucher');
            $userName = $this->input->post('userName');

            $this->load->model('VouchersModel');

            if (!$voucher = $this->VouchersModel->getByCode($voucherCode)) {
                $_SESSION['messageDanger'] = "Podany kod jest niepoprawny!";
                redirect(base_url('voucher'));
            }

            $this->load->model('ServicesModel');

            if (!$service = $this->ServicesModel->getByID($voucher['service'])) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj ponownie później!";
                redirect(base_url('voucher'));
            }

            $this->load->model('ServersModel');

            if (!$server = $this->ServersModel->getByID($service['server'])) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj ponownie później!";
                redirect(base_url('voucher'));
            }
    
            require_once(APPPATH.'libraries/MinecraftPing.php');
            require_once(APPPATH.'libraries/MinecraftPingException.php');
    
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
                    $_SESSION['messageDanger'] = "Serwer, na którym próbujesz wykorzystać voucher jest aktualnie wyłączony. Zapraszamy później!";
                    redirect(base_url('voucher' ));
                }
            }

            $data['buyer'] = $userName;
            $data['service'] = $service['id'];
            $data['server'] = $server['id'];
            $data['method'] = "Voucher";
            $data['info'] = "voucher:" . $voucherCode;
            $data['profit'] = 0;
            $data['date'] = time();

            $this->load->model('PurchasesModel');

            $this->PurchasesModel->add($data);

            if (!$this->VouchersModel->delete($voucher['id'])) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj ponownie później!";
                redirect(base_url('voucher'));
            }

            $commands = explode(";", $service['commands']);

            $this->load->helper('rcon_helper');

            $rconResponse = rconCommand($commands, $userName, $server['ip'], $server['rcon_port'], $server['rcon_pass']);

            if ($rconResponse['value']) {
                $_SESSION['messageSuccess'] = "Usługa <strong>" . $service['name'] . "</strong> z serwera <strong>" . $server['name'] . "</strong> została pomyślnie zrealizowana! Voucher został wykorzystany!";
            } else {
                $_SESSION['messageDanger'] = 'Wystąpił błąd podczas łączenia się z serwerem. Zachowaj kod vouchera i zgłoś się do Administratora!';
            }

            redirect(base_url('voucher'));
        } else {
            $_SESSION['messageDanger'] = "Proszę podać kod vouchera!";
            redirect(base_url('voucher'));
        }
    }
}