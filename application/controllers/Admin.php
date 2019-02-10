<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('DataModel');
        $this->load->library('form_validation');
    }

    public function checkSession()
    {
        $cek = $this->session->userdata("nip");
        if (empty($cek)) {
            return false;
        } else {
            return true;
        }
    }

    public function index()
    {
        if (!$this->checkSession()) {
           $data['login'] = "admin";
           $this->load->view('master/login', $data);
        } else {
            $data['page'] = 'admin/home';
            $data['profile'] = $this->DataModel->getWhere('nip', $this->session->userdata('nip'));
            $data['profile'] = $this->DataModel->getData('admin')->row();
            $this->load->view('master/dashboard', $data);
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('uname', 'NIP', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        $uname = $this->input->post('uname');
        $pass = $this->input->post('pass');
        //$bag = $this->input->post('bagian');
        if ($this->form_validation->run() == false) {
            $this->load->view('master/login');
        } else {
            $data = array(
                "nip" => $uname,
                "password" => $pass,
            );
            $result = $this->DataModel->Login("admin", $data)->row();
            if ($result != null) {
                $id = $result->id;
                $username = $result->nip;
                $level = "admin";
                $data_session = array(
                    'id' => $id,
                    'nip' => $username,
                    'level' => $level,
                    'status' => "login"
                );
                $this->session->set_userdata($data_session);
                redirect(base_url('index.php/admin/index'));
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <p>Username atau Password salah</p></div>');
                redirect(base_url('index.php/admin/index'));
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('index.php/admin/index'));
    }

}
