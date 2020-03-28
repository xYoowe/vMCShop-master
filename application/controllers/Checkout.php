<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

/**
 * Created with ♥ by Verlikylos on 13.08.2017 22:50.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Checkout extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function sms() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('smscode', 'smscode', 'required|trim');
        $this->form_validation->set_rules('serviceid', 'serviceid', 'required|trim');
        $this->form_validation->set_rules('servername', 'servername', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $userName = $this->input->post('username');
            $smsCode = $this->input->post('smscode');
            $serviceId = $this->input->post('serviceid');
            $serverName = $this->input->post('servername');

            $this->load->model('ServicesModel');

            if (!$service = $this->ServicesModel->getByID($serviceId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
                redirect(base_url('shop/' . $serverName));
            }

            $this->load->model('ServersModel');

            if (!$server = $this->ServersModel->getByName($serverName)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
                redirect(base_url('shop/' . $serverName));
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
                    $_SESSION['messageDanger'] = "Serwer, na którym próbujesz zakupić usługę jest aktualnie wyłączony. Zapraszamy później!";
                    redirect(base_url('shop/' . $serverName));
                }
            }

            $this->config->load('settings');

            $allow = false;

             if ($this->config->item('sms_operator') == "MicroSMS") {
                 $this->load->helper('payments/sms/microsms_helper');

                 $response = check($this->config->item('microsms_userid'), $service['sms_channel_id'], $service['sms_number'], $smsCode);

                 if (!$response['value']) {
                     $_SESSION['messageDanger'] = $response['message'];
                 } else {
                     $allow = true;
                 }
             } else if ($this->config->item('sms_operator') == "LvlUp") {
                 $this->load->helper('payments/sms/lvlup_helper');

                 $response = check($this->config->item('lvlup_userid'), $service['sms_number'], $smsCode);

                 if (!$response['value']) {
                     $_SESSION['messageDanger'] = $response['message'];
                 } else {
                     $allow = true;
                 }
             } else if ($this->config->item('sms_operator') == "Homepay") {
                 $this->load->helper('payments/sms/homepay_helper');

                 $response = check($this->config->item('homepay_userid'), $this->config->item('homepay_userapikey'), $service['sms_channel_id'], $smsCode);

                 if (!$response['value']) {
                     $_SESSION['messageDanger'] = $response['message'];
                 } else {
                     $allow = true;
                 }
             } else if ($this->config->item('sms_operator') == "Pukawka") {
                 $this->load->helper('payments/sms/pukawka_helper');
                 $this->load->helper('smsnumbers_helper');

                 $price = round(getPriceBrutto() * 0.53, 2);
                 $response = check($this->config->item('pukawka_userapikey'), $price, $smsCode);

                 if (!$response['value']) {
                     $_SESSION['messageDanger'] = $response['message'];
                 } else {
                     $allow = true;
                 }
             }

             if (!$allow) {
                 redirect(base_url('shop/' . $serverName));
             }

             $this->load->helper('smsnumbers_helper');

             $data['method'] = "SMS";
             $data['info'] = "code:".$smsCode;
             $data['profit'] = 0.45 * getPriceNetto($service['sms_number'], $this->config->item('sms_operator'));
             $data['buyer'] = $userName;
             $data['service'] = $service['id'];
             $data['server'] = $server['id'];
             $data['date'] = time();

             $this->load->model('PurchasesModel');

             $this->PurchasesModel->add($data);

            $commands = explode(";", $service['commands']);

            $this->load->helper('rcon_helper');

            $rconResponse = rconCommand($commands, $userName, $server['ip'], $server['rcon_port'], $server['rcon_pass']);

            if ($rconResponse['value']) {
                $_SESSION['messageSuccess'] = "Usługa <strong>" . $service['name'] . "</strong> została pomyślnie zrealizowana!";
            } else {
                $_SESSION['messageDanger'] = 'Wystąpił błąd podczas łączenia się z serwerem. Zachowaj kod SMS i zgłoś się do Administratora!';
            }

            redirect(base_url('shop/' . $serverName));
        } else {
            if ($serverName = $this->input->post('servername')) {
                redirect(base_url('shop/' . $serverName));
            } else {
                redirect(base_url());
            }
        }
        
    }
}