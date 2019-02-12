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

    public function data_pegawai()
    {
        if (!$this->checkSession()) {
            $data['login'] = "admin";
            $this->load->view('master/login', $data);
         } else {
             $data['page'] = 'admin/data_pegawai';
             $data['profile'] = $this->DataModel->getWhere('nip', $this->session->userdata('nip'));
             $data['profile'] = $this->DataModel->getData('admin')->row();
             $data['pegawai'] = $this->DataModel->getData('data_pegawai')->result();
             $this->load->view('master/dashboard', $data);
         }
    }
    public function data_penduduk()
    {
        if (!$this->checkSession()) {
            $data['login'] = "admin";
            $this->load->view('master/login', $data);
         } else {
             $data['page'] = 'admin/data_penduduk';
             $data['profile'] = $this->DataModel->getWhere('nip', $this->session->userdata('nip'));
             $data['profile'] = $this->DataModel->getData('admin')->row();
             $data['penduduk'] = $this->DataModel->getData('data_penduduk')->result();
             $this->load->view('master/dashboard', $data);
         }
    }
    public function tambah_pegawai()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
     
        if($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                    <span class="badge badge-pill badge-danger">Success</span>
                                                    Gagal Menambahkan Pastikan Semua Terisi dengan benar !
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button></div>');

            redirect(base_url('index.php/admin/data_pegawai'));
        } else {
            $data = array(
                'nip' => $nip,
                'nama' => $nama,
                'jabatan' => $jabatan
            );
            $simpan = $this->DataModel->insert('data_pegawai',$data);
            
            if($simpan){
                $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                                        <span class="badge badge-pill badge-primary">Success</span>
                                                        Berhasil Menambahkan
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button></div>');

                redirect(base_url('index.php/admin/data_pegawai'));
            }else{
                $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                    <span class="badge badge-pill badge-danger">Success</span>
                                                    Gagal Menyimpan Perubahan Pastikan Semua Terisi dengan benar !
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button></div>');

                redirect(base_url('index.php/admin/data_pegawai'));
            }
        }
    }
    public function tambah_penduduk()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tanggungan', 'Tanggungan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $tanggungan = $this->input->post('tanggungan');
        $alamat = $this->input->post('alamat');
     
        if($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                    <span class="badge badge-pill badge-danger">Success</span>
                                                    Gagal Menambahkan Pastikan Semua Terisi dengan benar !
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button></div>');

            redirect(base_url('index.php/admin/data_penduduk'));
        } else {
            $data = array(
                'nik' => $nik,
                'nama' => $nama,
                'alamat' => $alamat,
                'tanggungan' => $tanggungan
            );
            $simpan = $this->DataModel->insert('data_penduduk',$data);
            
            if($simpan){
                $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                                        <span class="badge badge-pill badge-primary">Success</span>
                                                        Berhasil Menambahkan
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button></div>');

                redirect(base_url('index.php/admin/data_penduduk'));
            }else{
                $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                        <span class="badge badge-pill badge-danger">Success</span>
                                                        Gagal Menyimpan Perubahan Pastikan Semua Terisi dengan benar !
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button></div>');

                redirect(base_url('index.php/admin/data_penduduk'));
            }
        }
    }
    public function ubah_pegawai()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
     
        if($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                    <span class="badge badge-pill badge-danger">Success</span>
                                                    Gagal Menyimpan Perubahan Pastikan Semua Terisi dengan benar !
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button></div>');

            redirect(base_url('index.php/admin/data_pegawai'));
        } else {
            $data = array(
                'nama' => $nama,
                'jabatan' => $jabatan
            );
            $simpan = $this->DataModel->update('nip',$nip,'data_pegawai',$data);
            
            if($simpan){
                $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                                        <span class="badge badge-pill badge-primary">Success</span>
                                                        Perubahan data berhasil disimpan
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button></div>');

                redirect(base_url('index.php/admin/data_pegawai'));
            }else{
                $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                    <span class="badge badge-pill badge-danger">Success</span>
                                                    Gagal Menyimpan Perubahan Pastikan Semua Terisi dengan benar !
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button></div>');

                 redirect(base_url('index.php/admin/data_pegawai'));
            }
        }
    }
    public function ubah_penduduk()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tanggungan', 'Tanggungan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $tanggungan = $this->input->post('tanggungan');
        $alamat = $this->input->post('alamat');
        if($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                    <span class="badge badge-pill badge-danger">Success</span>
                                                    Gagal Menyimpan Perubahan Pastikan Semua Terisi dengan benar !
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button></div>');

            redirect(base_url('index.php/admin/data_penduduk'));
        } else {
            $data = array(
                'nama' => $nama,
                'tanggungan' => $tanggungan,
                'alamat' => $alamat
            );
            $simpan = $this->DataModel->update('nik',$nik,'data_penduduk',$data);
            
            if($simpan){
                $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                                        <span class="badge badge-pill badge-primary">Success</span>
                                                        Perubahan data berhasil disimpan
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button></div>');

                redirect(base_url('index.php/admin/data_penduduk'));
            }else{
                $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                        <span class="badge badge-pill badge-danger">Success</span>
                                                        Gagal Menyimpan Perubahan Pastikan Semua Terisi dengan benar !
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button></div>');

                redirect(base_url('index.php/admin/data_penduduk'));
            }
        }
    }
    public function hapus_pegawai()
    {
        $nip = $this->input->get('nip');
       
        $delete = $this->DataModel->delete('nip',$nip,'data_pegawai');
        if($delete){
            $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                                    <span class="badge badge-pill badge-primary">Success</span>
                                                    Berhasil Menghapus Data
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button></div>');

            redirect(base_url('index.php/admin/data_pegawai'));
        }else{
            $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                    <span class="badge badge-pill badge-danger">Success</span>
                                                    Gagal Menghapus Kenangan
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button></div>');

            redirect(base_url('index.php/admin/data_pegawai'));
        }
        
    }
    public function hapus_penduduk()
    {
        $nik = $this->input->get('nik');
       
        $delete = $this->DataModel->delete('nik',$nik,'data_penduduk');
        if($delete){
            $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                                    <span class="badge badge-pill badge-primary">Success</span>
                                                    Berhasil Menghapus Data
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button></div>');

            redirect(base_url('index.php/admin/data_penduduk'));
        }else{
            $this->session->set_flashdata('pesan', '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                    <span class="badge badge-pill badge-danger">Success</span>
                                                    Gagal Menghapus kenangan
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button></div>');


            redirect(base_url('index.php/admin/data_penduduk'));
        }
    }

}
