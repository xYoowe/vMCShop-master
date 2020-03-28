<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

/**
 * Created with ♥ by Verlikylos on 25.06.2017 13:43.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {

        if (!$this->session->userdata('logged')) redirect(base_url());

        /**  Head Section  */

        $header_data['page_title'] = $this->config->item('page_title') . " | Dashboard";

        $this->load->view('panel/components/Header', $header_data);


        /**  Body Section  */

        $this->load->model('ServersModel');
        $this->load->model('ServicesModel');
        $this->load->model('PurchasesModel');
        $this->load->model('LogsModel');
        $this->load->model('User');
        $this->load->helper('date');
        require_once(APPPATH.'libraries/MinecraftPing.php');
        require_once(APPPATH.'libraries/MinecraftPingException.php');

        $purchases = $this->PurchasesModel->getAll();
        $bodyData['logs'] = $this->LogsModel->getBySection('Logowanie');
        $bodyData['serversCount'] = $this->ServersModel->count();
        $bodyData['purchasesCount'] = $this->PurchasesModel->count();
        $bodyData['usersCount'] = $this->User->count();
        $bodyData['servers'] = array();
        $bodyData['purchases'] = array();
        $servers = $this->ServersModel->getAll();
        $services = $this->ServicesModel->getAll();
        $serverPurchases = array();
        $profit = 0;

        $todayTimestamp = time();
        $today = getOnlyDate($todayTimestamp);

        $yesterdayTimestamp = $todayTimestamp - 86400;
        $yesterday = getOnlyDate($yesterdayTimestamp);

        $twoDaysAgoTimestamp = $yesterdayTimestamp - 86400;
        $twoDaysAgo = getOnlyDate($twoDaysAgoTimestamp);

        $threeDaysAgoTimestamp = $twoDaysAgoTimestamp - 86400;
        $threeDaysAgo = getOnlyDate($threeDaysAgoTimestamp);

        $fourDaysAgoTimestamp = $threeDaysAgoTimestamp - 86400;
        $fourDaysAgo = getOnlyDate($fourDaysAgoTimestamp);

        $fiveDaysAgoTimestamp = $fourDaysAgoTimestamp - 86400;
        $fiveDaysAgo = getOnlyDate($fiveDaysAgoTimestamp);

        $sixDaysAgoTimestamp = $fiveDaysAgoTimestamp - 86400;
        $sixDaysAgo = getOnlyDate($sixDaysAgoTimestamp);

        $todayPurchases = array();
        $yesterdayPurchases = array();
        $twoDaysAgoPurchases = array();
        $threeDaysAgoPurchases = array();
        $fourDaysAgoPurchases = array();
        $fiveDaysAgoPurchases = array();
        $sixDaysAgoPurchases = array();

        foreach ($purchases as $purchase) {
            $profit += $purchase['profit'];

            if (getOnlyDate($purchase['date']) == $today) array_push($todayPurchases, $purchase);
            if (getOnlyDate($purchase['date']) == $yesterday) array_push($yesterdayPurchases, $purchase);
            if (getOnlyDate($purchase['date']) == $twoDaysAgo) array_push($twoDaysAgoPurchases, $purchase);
            if (getOnlyDate($purchase['date']) == $threeDaysAgo) array_push($threeDaysAgoPurchases, $purchase);
            if (getOnlyDate($purchase['date']) == $fourDaysAgo) array_push($fourDaysAgoPurchases, $purchase);
            if (getOnlyDate($purchase['date']) == $fiveDaysAgo) array_push($fiveDaysAgoPurchases, $purchase);
            if (getOnlyDate($purchase['date']) == $sixDaysAgo) array_push($sixDaysAgoPurchases, $purchase);
        }

        if (getDayNumber($todayTimestamp) == 7) {
            $footerData['chartValues'] = count($sixDaysAgoPurchases) . ", " . count($fiveDaysAgoPurchases) . ", " . count($fourDaysAgoPurchases) . ", " . count($threeDaysAgoPurchases) . ", " . count($twoDaysAgoPurchases) . ", " . count($yesterdayPurchases) . ", " . count($todayPurchases);
            $higest = max(count($todayPurchases), count($yesterdayPurchases), count($twoDaysAgoPurchases), count($threeDaysAgoPurchases), count($fourDaysAgoPurchases), count($fiveDaysAgoPurchases), count($sixDaysAgoPurchases));
        }
        if (getDayNumber($todayTimestamp) == 6) {
            $footerData['chartValues'] = count($fiveDaysAgoPurchases) . ", " . count($fourDaysAgoPurchases) . ", " . count($threeDaysAgoPurchases) . ", " . count($twoDaysAgoPurchases) . ", " . count($yesterdayPurchases) . ", " . count($todayPurchases);
            $higest = max(count($todayPurchases), count($yesterdayPurchases), count($twoDaysAgoPurchases), count($threeDaysAgoPurchases), count($fourDaysAgoPurchases), count($fiveDaysAgoPurchases));
        }
        if (getDayNumber($todayTimestamp) == 5) {
            $footerData['chartValues'] = count($fourDaysAgoPurchases) . ", " . count($threeDaysAgoPurchases) . ", " . count($twoDaysAgoPurchases) . ", " . count($yesterdayPurchases) . ", " . count($todayPurchases);
            $higest = max(count($todayPurchases), count($yesterdayPurchases), count($twoDaysAgoPurchases), count($threeDaysAgoPurchases), count($fourDaysAgoPurchases));
        }
        if (getDayNumber($todayTimestamp) == 4) {
            $footerData['chartValues'] = count($threeDaysAgoPurchases) . ", " . count($twoDaysAgoPurchases) . ", " . count($yesterdayPurchases) . ", " . count($todayPurchases);
            $higest = max(count($todayPurchases), count($yesterdayPurchases), count($twoDaysAgoPurchases), count($threeDaysAgoPurchases));
        }
        if (getDayNumber($todayTimestamp) == 3) {
            $footerData['chartValues'] = count($twoDaysAgoPurchases) . ", " . count($yesterdayPurchases) . ", " . count($todayPurchases);
            $higest = max(count($todayPurchases), count($yesterdayPurchases), count($twoDaysAgoPurchases));
        }
        if (getDayNumber($todayTimestamp) == 2) {
            $footerData['chartValues'] = count($yesterdayPurchases) . ", " . count($todayPurchases);
            $higest = max(count($todayPurchases), count($yesterdayPurchases));
        }
        if (getDayNumber($todayTimestamp) == 1) {
            $footerData['chartValues'] = count($todayPurchases);
            $higest = count($todayPurchases);
        }

        if (in_array($higest, array(0, 1, 2, 3, 4))) {
            $footerData['chartHigest'] = 5;
        } else {
            $footerData['chartHigest'] = round(($higest * 1.3), 2);
        }

        $yesterdayTransactions = count($yesterdayPurchases);
        $todayTransactions = count($todayPurchases);

        if (($todayTransactions == 0) && ($yesterdayTransactions == 0)) {
            $bodyData['percentTransactions'] = 0;
        } else if ($todayTransactions == 0) {
            $bodyData['percentTransactions'] = -100;
        } else if ($yesterdayTransactions == 0) {
            $bodyData['percentTransactions'] = 100;
        } else {
            $bodyData['percentTransactions'] = round((($todayTransactions * 100) / $yesterdayTransactions) - 100, 0);
        }

        $bodyData['profit'] = number_format(round($profit, 2), 2, ',', ' ');
        
        foreach ($servers as $server) {
    
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
            
            foreach ($this->PurchasesModel->getForServerLimit($server['id'], 5) as $serv) {
                array_push($serverPurchases, $serv);
            }
        }
    
        foreach ($servers as $server) {
        
            for ($i = 0; $i < count($serverPurchases); $i++) {
                if ($serverPurchases[$i]['server'] == $server['id']) {
                    $serverPurchases[$i]['server'] = $server['name'];
                }
            }
        }
    
        foreach ($services as $service) {
        
            for ($i = 0; $i < count($serverPurchases); $i++) {
                if ($serverPurchases[$i]['service'] == $service['id']) {
                    $serverPurchases[$i]['service'] = $service['name'];
                }
            }
        }
    
        foreach ($serverPurchases as $purchase) {
            if (is_numeric($purchase['service'])) $purchase['service'] = "Usługa została usunięta!";
            if (is_numeric($purchase['server'])) $purchase['server'] = "Serwer został usunięty!";
            if ($purchase['method'] == "SMS") $purchase['method'] = "<span class='label label-warning'>SMS Premium</span>";
            if ($purchase['method'] == "PayPal") $purchase['method'] = "<span class='label label-info'>PayPal</span>";
            if ($purchase['method'] == "Voucher") $purchase['method'] = "<span class='label label-danger'>Voucher</span>";
            array_push($bodyData['purchases'], $purchase);
        }

        $this->load->view('panel/Dashboard', $bodyData);


        /**  Footer Section  */

        $this->load->view('panel/components/Footer', $footerData);
        
    }
}