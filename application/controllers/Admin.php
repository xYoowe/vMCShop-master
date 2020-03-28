<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 23.06.2017 03:07.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {

        if ($this->session->userdata('logged')) redirect(base_url('panel/dashboard'));

        $this->benchmark->mark('code_start');

        $this->load->library('form_validation');

        /**  Head Section  */

        $header_data['page_title'] = $this->config->item('page_title') . " | Logowanie do ACP";

        $this->load->view('components/Header', $header_data);


        /**  Body Section  */
    
        $this->load->model('ServersModel');
        $this->load->model('PagesModel');
    
        $bodyData['servers'] = $this->ServersModel->getAll();
        $bodyData['pages'] = $this->PagesModel->getAll();

        $this->load->view('Login', $bodyData);


        /**  Footer Section  */


        $this->benchmark->mark('code_end');

        $footer_data['benchmark'] = $this->benchmark->elapsed_time('code_start', 'code_end');

        $this->load->view('components/Footer', $footer_data);

    }

    public function login() {
        if ($this->session->userdata('logged')) redirect(base_url('panel/dashboard'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('login', 'Login', 'required|trim');
        $this->form_validation->set_rules('pass', 'Hasło', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $login = $this->input->post('login');
            $pass = $this->input->post('pass');

            $this->load->model('User');

            if (!$user = $this->User->getByName($login)) {
                $_SESSION['messageDanger'] = "Podano nieprawidłowy login lub hasło!";
                redirect(base_url('admin'));
            }

            if (!password_verify($pass, $user['password'])) {
                $_SESSION['messageDanger'] = "Podano nieprawidłowy login lub hasło!";
                redirect(base_url('admin'));
            }

            $this->session->set_userdata('logged', TRUE);
            $this->session->set_userdata('name', $user['name']);
            $this->session->set_userdata('avatar', $user['avatar']);

            $data['lastIP'] = getenv('HTTP_CLIENT_IP') ? : getenv('HTTP_X_FORWARDED_FOR') ? : getenv('HTTP_X_FORWARDED') ? : getenv('HTTP_FORWARDED_FOR') ? : getenv('HTTP_FORWARDED') ? : getenv('REMOTE_ADDR');
            if ($data['lastIP'] == "::1") $data['lastIP'] = "127.0.0.1";
            $ip = $data['lastIP'];
            $data['lastLogin'] = time();

            $this->User->update($user['name'], $data);

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Logowanie";
            $data['details'] = $ip;
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Zalogowano pomyślnie! Witaj w panelu administratora " . $user['name'] . "!";
            redirect(base_url('panel/dashboard'));
        } else {
            $_SESSION['messageDanger'] = "Proszę wypełnić wszystkie pola formularza logowania!";
            redirect(base_url('admin'));
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}