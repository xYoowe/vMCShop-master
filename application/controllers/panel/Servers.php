<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 25.07.2017 21:02.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Servers extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {

        if (!$this->session->userdata('logged')) redirect(base_url());

        /**  Head Section  */

        $header_data['page_title'] = $this->config->item('page_title') . " | Serwery";

        $this->load->view('panel/components/Header', $header_data);


        /**  Body Section  */

        $this->load->model('ServersModel');
        $this->load->library('form_validation');

        $bodyData['servers'] = $this->ServersModel->getAll();

        $this->load->view('panel/Servers', $bodyData);


        /**  Footer Section  */

        $this->load->view('panel/components/Footer');

    }

    public function create() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');

        $this->form_validation->set_rules('serverName', 'serverName', 'required|trim');
        $this->form_validation->set_rules('serverIp', 'serverIp', 'required|trim');
        $this->form_validation->set_rules('serverQueryPort', 'serverQueryPort', 'required|trim');
        $this->form_validation->set_rules('serverRconPort', 'serverRconPort', 'required|trim');
        $this->form_validation->set_rules('serverRconPass', 'serverRconPass', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $data['name'] = $this->input->post('serverName');

            if (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $data['name'])) {
                $_SESSION['messageDanger'] = "Nazwa serwera zawiera niedozwolone znaki!";
                redirect(base_url('panel/servers'));
            }

            $this->load->model('ServersModel');

            if ($this->ServersModel->getByName($data['name'])) {
                $_SESSION['messageDanger'] = "Serwer o takiej nazwie już istnieje!";
                redirect(base_url('panel/servers'));
            }

            $data['ip'] = $this->input->post('serverIp');
            $data['query_port'] = $this->input->post('serverQueryPort');
            $data['rcon_port'] = $this->input->post('serverRconPort');
            $data['rcon_pass'] = $this->input->post('serverRconPass');
            $serverName = $data['name'];

            if (!$this->ServersModel->add($data)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/servers'));
            }

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Serwery";
            $data['details'] = "Użytkownik dodał <strong>serwer</strong> o nazwie <strong>" . $serverName . "</strong>";
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Pomyślnie dodano serwer o nazwie <strong>" . $serverName ."</strong>!";
            redirect(base_url('panel/servers'));
        } else {
            $_SESSION['messageDanger'] = "Proszę wypełnić wszystkie pola formularza!";
            redirect(base_url('panel/servers'));
        }
    }

    public function remove() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');

        $this->form_validation->set_rules('serverId', 'serverId', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $serverId = $this->input->post('serverId');

            $this->load->model('ServersModel');

            if (!$server = $this->ServersModel->getByID($serverId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
                redirect(base_url('panel/servers'));
            }

            if (!$this->ServersModel->delete($serverId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/servers'));
            }

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Serwery";
            $data['details'] = "Użytkownik usunał <strong>serwer</strong> o nazwie <strong>" . $server['name'] . "</strong>";
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Pomyślnie usunięto serwer o nazwie <strong>" . $server['name'] . "</strong>!";
            redirect(base_url('panel/servers'));
        } else {
            $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
            redirect(base_url('panel/servers'));
        }
    }
}