<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('DataModel');
        // $this->load->model('PerhitunganModel');
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

    public function laporan_penerima()
    {
        if (!$this->checkSession()) {
            $data['login'] = "admin";
            $this->load->view('master/login', $data);
         } else {

            // KRITERIA DAN SUB KRITERIA
            $kriteria = $this->DataModel->getData("kriteria")->result();
            $subKriteria = array();
            foreach($kriteria as $x){
                $idKriteria = $this->DataModel->getWhere('idKriteria', $x->id);
                $idKriteria = $this->DataModel->getData('subkriteria')->result();
                foreach($idKriteria as $z){
                    $idKriteriaKey = $z->idKriteria;
                    $subKriteria[$idKriteriaKey][] = array(
                        "subDari"   => $x->nama,
                        "nama"      => $z->nama,
                        "value"     => $z->value
                    );
                }
            }

            // DATA NILAI PENDUDUK
            $nilai_nikPenduduk = $this->DataModel->select(array("nikPenduduk"));
            $nilai_nikPenduduk = $this->DataModel->distinct();
            $nilai_nikPenduduk = $this->DataModel->getData("nilai")->result();
            $dataNilaiPendudukXXX = array();
            foreach($nilai_nikPenduduk as $np){
                $pendudukPerNik = $this->DataModel->getWhere("nikPenduduk", $np->nikPenduduk);
                $pendudukPerNik = $this->DataModel->getData("nilai")->result();
                $index = 0;
                $terpilih = array();
                foreach($kriteria as $k){
                    for($i = 0 ; $i < sizeof($pendudukPerNik) ; $i++){
                        if($k->id == $pendudukPerNik[$i]->idKriteria){
                            $namaValue = $this->DataModel->getWhere("id", (int) $pendudukPerNik[$i]->id_subKriteria);
                            $namaValue = $this->DataModel->getData("subkriteria")->result();
                            $dataNilaiPendudukXXX["nik-".$np->nikPenduduk][$index] = array(
                                "namaSubkategori" => $namaValue[0]->nama,
                                "value" => $namaValue[0]->value
                            );
                            $terpilih[] = $index;
                        }
                    }
                    $index++;
                }
                for($i = 0 ; $i < sizeof($kriteria) ; $i++){
                    if(!in_array($i, $terpilih)){
                        $dataNilaiPendudukXXX["nik-".$np->nikPenduduk][$i] = array(
                            "namaSubkategori" => "",
                            "value" => ""
                        );
                    }
                }
            }

            // die(json_encode($dataNilaiPendudukXXX));
            $dataNilaiPenduduk = $this->DataModel->select(array(
                "data_penduduk.nik as nik", 
                "data_penduduk.nama as nama_orang", 
                "kriteria.nama as nama_kriteria",
                "subkriteria.nama as nama_sub_kriteria",
                "subkriteria.value as value"));

            $dataNilaiPenduduk = $this->DataModel->getJoin("data_penduduk","nilai.nikPenduduk = data_penduduk.nik","INNER");
            $dataNilaiPenduduk = $this->DataModel->getJoin("kriteria","nilai.idKriteria = kriteria.id","INNER");
            $dataNilaiPenduduk = $this->DataModel->getJoin("subkriteria","nilai.id_subKriteria = subkriteria.id","INNER");
            $dataNilaiPenduduk = $this->DataModel->getData("nilai")->result();

            $dataNamaPenduduk = $this->DataModel->select(array("data_penduduk.nama", "data_penduduk.nik"));
            $dataNamaPenduduk = $this->DataModel->distinct();
            $dataNamaPenduduk = $this->DataModel->getJoin("data_penduduk","nilai.nikPenduduk = data_penduduk.nik","INNER");
            $dataNamaPenduduk = $this->DataModel->getData("nilai")->result();

            //NORMALISASI DATA
            $normalisasiNilaiX = array();
            $indexNormalisasi = 0;
            foreach($kriteria as $k){
                $nilaiMinMax = 0;

                $getMinMax = $this->DataModel->select(array(
                    "subkriteria.value as value"));
                $getMinMax = $this->DataModel->getJoin("subkriteria","nilai.id_subKriteria = subkriteria.id","INNER");
                $ambilData = $this->DataModel->getWhere("nilai.idKriteria", (int) $k->id);
                $getMinMax  = $this->DataModel->order_by("value", $k->sifat == "cost" ? "ASC" : "DESC");
                $getMinMax  = $this->DataModel->limit(1);
                $getMinMax  = $this->DataModel->getData("nilai")->result()[0]->value;

                $nilaiMinMax = floatval($getMinMax);
                // $nilaiMinMax = 0;

                $ambilData = $this->DataModel->select(array(
                    "data_penduduk.nik as nik",
                    "data_penduduk.nama as nama",
                    "subKriteria.value as value"));
                $ambilData = $this->DataModel->getJoin("data_penduduk","nilai.nikPenduduk = data_penduduk.nik","INNER");
                $ambilData = $this->DataModel->getJoin("kriteria","nilai.idKriteria = kriteria.id","INNER");
                $ambilData = $this->DataModel->getJoin("subkriteria","nilai.id_subKriteria = subkriteria.id","INNER");
                $ambilData = $this->DataModel->getWhere("nilai.idKriteria", (int) $k->id);
                $ambilData = $this->DataModel->getData("nilai")->result();
                
                // die(json_encode(floatval($getMinMax)));
                // die(json_encode($kriteria));
                
                for($i = 0 ; $i < sizeof($ambilData) ; $i++){
                   $normalisasiNilaiX["nik-".$ambilData[$i]->nik][$indexNormalisasi] = array(
                       "sifat"              => $k->sifat,
                       "perhitungan"        => $k->sifat == "cost" ? "min X / X" : "X / Max X",
                       "value_asli"         => floatval($ambilData[$i]->value),
                       "minMax"             => $nilaiMinMax,
                       "value_normalisasi"  => $nilaiMinMax == 0 ? "000" : ($k->sifat == "cost" ? 
                                                floatval(number_format(($nilaiMinMax/floatval($ambilData[$i]->value)),2)) : 
                                                floatval(number_format((floatval($ambilData[$i]->value)/$nilaiMinMax),2))),
                        "bobot"             => floatval($k->bobot),
                        "hasil"             => $nilaiMinMax == 0 ? "000" : ($k->sifat == "cost" ? 
                                                (floatval(number_format(($nilaiMinMax/floatval($ambilData[$i]->value))*floatval($k->bobot),2))) : 
                                                floatval(number_format(((floatval($ambilData[$i]->value)/$nilaiMinMax))*floatval($k->bobot),2)))
                   );
                }
                $indexNormalisasi++;
            }
            // die(json_encode($normalisasiNilaiX));
            $hasilAkhir = array();
            for($i = 0 ; $i < sizeof($ambilData) ; $i++){
                $nilaiHasilAkhir = 0;
                foreach($normalisasiNilaiX["nik-".$ambilData[$i]->nik] as $apaya){
                    $nilaiHasilAkhir += $apaya["hasil"];
                    // die(json_encode($apaya["hasil"]));
                }
                $hasilAkhir[$ambilData[$i]->nik] = floatval(number_format(($nilaiHasilAkhir),2));
                
            }

            $namaSamaNik = array();
            for($i = 0 ; $i < sizeof($dataNamaPenduduk) ; $i++){
                $namaSamaNik[$dataNamaPenduduk[$i]->nik] = $dataNamaPenduduk[$i]->nama;
            }

            arsort($hasilAkhir); //sortir kang gede maring cilik hehe
            // die(json_encode($hasilAkhir));

            $data['kriteria'] = $kriteria;
            $data['dataNilaiPenduduk'] = $dataNilaiPenduduk;
            $data['dataNamaPenduduk'] = $dataNamaPenduduk;
            $data['namaSamaNik'] = $namaSamaNik;
            $data['normalisasiNilaiX'] = $normalisasiNilaiX;
            $data['dataNilaiPendudukXXX'] = $dataNilaiPendudukXXX;
            $data['subKriteria'] = $subKriteria;
            $data['hasilAkhir'] = $hasilAkhir;
            $data['page'] = 'admin/laporan_penerima';
            $data['kriteria'] = $this->DataModel->getData('kriteria')->result();

            // die(json_encode($data));
            $this->load->view('master/dashboard', $data);
        }
    }

}
