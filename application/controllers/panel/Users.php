<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 09.07.2017 22:18.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Users extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {

        if (!$this->session->userdata('logged')) redirect(base_url());

        /**  Head Section  */

        $header_data['page_title'] = $this->config->item('page_title') . " | Użytkownicy ACP";

        $this->load->view('panel/components/Header', $header_data);


        /**  Body Section  */

        $this->load->model('User');
        $this->load->library('form_validation');
        $this->load->helper('date_helper');

        $bodyData['users'] = $this->User->getAll();

        $this->load->view('panel/Users', $bodyData);


        /**  Footer Section  */

        $this->load->view('panel/components/Footer');

    }

    public function create() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');
        $this->load->helper('string');

        $this->form_validation->set_rules('userName', 'userName', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $data['name'] = $this->input->post('userName');

            $this->load->model('User');

            if ($this->User->getByName($data['name'])) {
                $_SESSION['messageDanger'] = "Użytkownik o takiej nazwie już istnieje!";
                redirect(base_url('panel/users'));
            }

            $password = random_string('alnum', 16);
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            $data['avatar'] = base_url('assets/images/avatars/default-avatar.png');
            $userName = $data['name'];

            if (!$this->User->add($data)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/users'));
            }

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Użytkownicy ACP";
            $data['details'] = "Utworzono nowego <strong>użytkownika</strong> o nazwie <strong>" . $userName . "</strong>";
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Pomyślnie utworzono nowego użytkownika o nazwie <strong>" . $userName ."</strong>!";
            $_SESSION['newUserInfo'] = "Dane logowania do ACP dla nowego użytkownika:<br />Nazwa użytkownika: <strong>" . $userName . "</strong>, Hasło: <strong>" . $password ."</strong><br /><br />Wyślij te dane jak najszybciej do nowego administratora, ponieważ znikną po przeładowaniu strony!";
            redirect(base_url('panel/users'));
        } else {
            $_SESSION['messageDanger'] = "Proszę wypełnić wszystkie pola formularza!";
            redirect(base_url('panel/users'));
        }
    }

    public function remove() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');

        $this->form_validation->set_rules('userId', 'userId', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $userId = $this->input->post('userId');

            $this->load->model('User');

            if (!$user = $this->User->getByID($userId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
                redirect(base_url('panel/users'));
            }

            if ($_SESSION['name'] == $user['name']) {
                $_SESSION['messageDanger'] = "Nie możesz usunąć swojego konta!";
                redirect(base_url('panel/users'));
            }

            if (!$this->User->delete($userId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/users'));
            }

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Użytkownicy ACP";
            $data['details'] = "Usunięto <strong>użytkownika</strong> o nazwie <strong>" . $user['name'] . "</strong>";
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Pomyślnie usunięto użytkownika o nazwie <strong>" . $user['name'] . "</strong>!";
            redirect(base_url('panel/users'));
        } else {
            $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
            redirect(base_url('panel/users'));
        }
    }
}