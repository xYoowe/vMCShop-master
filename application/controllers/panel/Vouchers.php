<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 14.08.2017 00:50.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Vouchers extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {

        if (!$this->session->userdata('logged')) redirect(base_url());

        /**  Head Section  */

        $header_data['page_title'] = $this->config->item('page_title') . " | Vouchery";

        $this->load->view('panel/components/Header', $header_data);


        /**  Body Section  */

        $this->load->model('VouchersModel');
        $this->load->model('ServersModel');
        $this->load->model('ServicesModel');
        $this->load->library('form_validation');

        $vouchers = $this->VouchersModel->getAll();
        $servers = $this->ServersModel->getAll();
        $services = $this->ServicesModel->getAll();
        $bodyData['vouchers'] = array();
        $bodyData['services'] = array();

        foreach ($services as $service) {

            foreach ($servers as $server) {
                if ($server['id'] == $service['server']) {
                    $service['server'] = $server['name'];

                    array_push($bodyData['services'], $service);
                }
            }

            foreach ($vouchers as $voucher) {

                if ($service['id'] == $voucher['service']) {
                    $voucher['service'] = $service['name'];
                    $voucher['server'] = $service['server'];

                    array_push($bodyData['vouchers'], $voucher);
                }

            }

        }

        $this->load->view('panel/Vouchers', $bodyData);


        /**  Footer Section  */

        $this->load->view('panel/components/Footer');

    }

    public function create() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');
        $this->load->helper('string');

        $this->form_validation->set_rules('voucherService', 'voucherService', 'required|trim');
        $this->form_validation->set_rules('voucherAmount', 'Amount', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $data['service'] = $this->input->post('voucherService');
            $amount = $this->input->post('voucherAmount');
            $vouchers = array();

            $this->load->model('VouchersModel');
            $this->load->model('ServicesModel');
            $this->config->load('settings');

            if (!$service = $this->ServicesModel->getByID($data['service'])) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
                redirect(base_url('panel/vouchers'));
            }

            for ($i = 1; $i <= $amount; $i++) {
                $data['code'] = $this->config->item('voucher_prefix') . random_string('alpha', $this->config->item('voucher_lenght'));
                array_push($vouchers, $data);
            }

            if (!$this->VouchersModel->addMultiple($vouchers)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/vouchers'));
            }

            $vouchersList = "";
            $i = 1;

            foreach ($vouchers as $voucher) {
                $vouchersList = $vouchersList . "<strong>". $i . ".</strong> " . $voucher['code'] . "<br />";
                $i++;
            }

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Vouchery";
            $data['details'] = "Użytkownik wygenerował <strong>" . $amount . " voucherów</strong> dla usługi <strong>" . $service['name'] . "</strong>";
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Pomyślnie wygenerowano <strong>" . $amount . "</strong> voucherów dla usługi <strong>" . $service['name'] . "</strong>!";
            $_SESSION['vouchers'] = $vouchersList;
            redirect(base_url('panel/vouchers'));
        } else {
            $_SESSION['messageDanger'] = "Proszę wypełnić wszystkie pola formularza!";
            redirect(base_url('panel/vouchers'));
        }
    }

    public function remove() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');

        $this->form_validation->set_rules('voucherId', 'voucherId', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $voucherId = $this->input->post('voucherId');

            $this->load->model('VouchersModel');

            if (!$voucher = $this->VouchersModel->getByID($voucherId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
                redirect(base_url('panel/vouchers'));
            }

            if (!$this->VouchersModel->delete($voucherId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/vouchers'));
            }

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Voucher";
            $data['details'] = "Użytkownik usunał <strong>voucher</strong> o ID <strong>" . $voucher['id'] . "</strong>";
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Pomyślnie usunięto voucher o ID <strong>" . $voucher['id'] . "</strong>!";
            redirect(base_url('panel/vouchers'));
        } else {
            $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
            redirect(base_url('panel/vouchers'));
        }
    }
}