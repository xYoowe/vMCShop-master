<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 27.06.2017 13:52.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Account extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {

        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->benchmark->mark('code_start');

        /**  Head Section  */

        $header_data['page_title'] = $this->config->item('page_title') . " | Dashboard";

        $this->load->view('panel/components/Header', $header_data);


        /**  Body Section  */

        $this->load->library('form_validation');

        $this->load->view('panel/Account');


        /**  Footer Section  */


        $this->benchmark->mark('code_end');

        $footer_data['benchmark'] = $this->benchmark->elapsed_time('code_start', 'code_end');

        $this->load->view('panel/components/Footer', $footer_data);

    }

    public function changePassword() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');

        $this->form_validation->set_rules('pass1', 'Hasło1', 'required|trim');
        $this->form_validation->set_rules('pass2', 'Hasło2', 'required|trim');
        $this->form_validation->set_rules('pass3', 'Hasło3', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $pass1 = $this->input->post('pass1');
            $pass2 = $this->input->post('pass2');
            $pass3 = $this->input->post('pass3');

            $this->load->model('User');

            if (!$user = $this->User->getByName($_SESSION['name'])) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
                redirect(base_url('panel/account'));
            }

            if (!password_verify($pass1, $user['password'])) {
                $_SESSION['messageDanger'] = "Podano nieprawidłowe aktualne hasło!";
                redirect(base_url('panel/account'));
            }

            if ($pass2 != $pass3) {
                $_SESSION['messageDanger'] = "Podane hasła nie pasują do siebie!";
                redirect(base_url('panel/account'));
            }

            $data['password'] = password_hash($pass2, PASSWORD_DEFAULT);

            if (!$this->User->update($user['name'], $data)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/account'));
            }

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Ustawienia Konta";
            $data['details'] = "Użytkownik zmienił <strong>swoje hasło</strong>";
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Hasło zostało pomyślnie zmienione!";
            redirect(base_url('panel/account'));
        } else {
            $_SESSION['messageDanger'] = "Proszę wypełnić wszystkie pola formularza!";
            redirect(base_url('panel/account'));
        }
    }

    public function changeAvatar() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $config['upload_path'] = './assets/images/avatars';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 10240;
        $config['max_width'] = 256;
        $config['max_height'] = 256;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('avfile')) {

            $this->load->model('User');

            $uploadData = $this->upload->data();
            $data['avatar'] = base_url('assets/images/avatars/' . $uploadData['file_name']);

            if (!$this->User->update($_SESSION['name'], $data)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/account'));
            }

            $_SESSION['avatar'] = base_url('assets/images/avatars/' . $uploadData['file_name']);

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Ustawienia Konta";
            $data['details'] = "Użytkownik zmienił <strong>swój avatar</strong>";
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Avatar został pomyślnie zmieniony!";
            redirect(base_url('panel/account'));

        } else {

            $_SESSION['messageDanger'] = $this->upload->display_errors();
            redirect(base_url('panel/account'));

        }
    }
}