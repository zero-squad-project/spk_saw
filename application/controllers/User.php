<?php

class User extends CI_Controller
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
        $cek = $this->session->userdata("nik");
        if (empty($cek)) {
            return false;
        } else {
            return true;
        }
    }

    public function index(){
        if (!$this->checkSession()) {
           $data['login'] = "user";
           $this->load->view('master/login', $data);
        } else {
            $data['ap'] = 'user';
            // $data['page'] = 'user/home';
            $data['profile'] = $this->DataModel->getWhere('nik', $this->session->userdata('nik'));
            $data['profile'] = $this->DataModel->getData('data_penduduk')->row();
            $this->load->view('user/home_new', $data);
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('uname', 'Username', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');

        $uname = $this->input->post('uname');
        $pass = $this->input->post('pass');

        if ($this->form_validation->run() == false) {
            $data['login'] = "user";
            $this->load->view('master/login', $data);
        } else {
            $data = array(
                "nik" => $uname,
                "password" => $pass,
            );
            $result = $this->DataModel->Login("user", $data)->row();

            if ($result != null) {
                $id = $result->nik;
                //$username = $result->username;
                $level = "user";
                $data_session = array(
                    'nik' => $id,
                    'level' => $level,
                    'status' => "login",
                );
                $this->session->set_userdata($data_session);
                redirect(base_url('index.php/user/index'));
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <p>Username atau Password salah</p></div>');
                $data['login'] = "user";
                $this->load->view('master/login', $data);
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('index.php/user/index'));
    }

}

