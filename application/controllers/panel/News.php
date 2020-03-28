<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 10.08.2017 21:55.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class News extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {

        if (!$this->session->userdata('logged')) redirect(base_url());

        /**  Head Section  */

        $header_data['page_title'] = $this->config->item('page_title') . " | Newsy";

        $this->load->view('panel/components/Header', $header_data);


        /**  Body Section  */

        $this->load->library('form_validation');
        $this->load->model('NewsModel');
        $this->load->helper('date_helper');

        $bodyData['news'] = $this->NewsModel->getAll();

        $this->load->view('panel/News', $bodyData);


        /**  Footer Section  */

        $this->load->view('panel/components/Footer');

    }

    public function create() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');

        $this->form_validation->set_rules('newsTitle', 'newsTitle', 'required|trim');
        $this->form_validation->set_rules('newsContent', 'newsContent', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $data['title'] = $this->input->post('newsTitle');
            $data['content'] = $this->input->post('newsContent');
            $data['date'] = time();
            $newsTitle = $data['title'];

            $this->load->helper('string');

            $config['upload_path'] = './assets/images/news';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 10240;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('newsImage')) {

                $uploadData = $this->upload->data();
                $data['image'] = base_url('assets/images/news/' . $uploadData['file_name']);

            } else {

                $_SESSION['messageDanger'] = $this->upload->display_errors();
                redirect(base_url('panel/news'));

            }

            $this->load->model('NewsModel');


            if (!$this->NewsModel->add($data)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/news'));
            }

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Newsy";
            $data['details'] = "Użytkownik dodał <strong>news</strong> o tytule \"<strong>" . $newsTitle . "</strong>\"";
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Pomyślnie utworzono newsa <strong>" . $newsTitle . "</strong>!";
            redirect(base_url('panel/news'));
        } else {
            $_SESSION['messageDanger'] = "Proszę wypełnić wszystkie pola formularza!";
            redirect(base_url('panel/news'));
        }
    }

    public function remove() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');

        $this->form_validation->set_rules('newsId', 'newsId', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $newsId = $this->input->post('newsId');

            $this->load->model('NewsModel');

            if (!$news = $this->NewsModel->getByID($newsId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
                redirect(base_url('panel/news'));
            }

            if (!$this->NewsModel->delete($newsId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/news'));
            }

            unset($data);

            $data['user'] = $_SESSION['name'];
            $data['section'] = "Newsy";
            $data['details'] = "Użytkownik usunął <strong>news</strong> o tytule \"<strong>" . $news['title'] . "</strong>\" (ID:" . $news['id'] . ")";
            $data['date'] = time();

            $this->load->model('LogsModel');
            $this->LogsModel->add($data);

            $_SESSION['messageSuccess'] = "Pomyślnie usunięto news <strong>" . $news['title'] . " (ID:" . $news['id'] . ")</strong>!";
            redirect(base_url('panel/news'));
        } else {
            $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
            redirect(base_url('panel/news'));
        }
    }
}