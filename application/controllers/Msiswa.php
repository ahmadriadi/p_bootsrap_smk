<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Msiswa extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Msiswa_model', 'modsiswa');
    }

    public function index() {
        $data = array(
            "base" => base_url(),
            "url_grid" => site_url('msiswa/grid'),
            "url_add" => site_url('msiswa/add'),
            "url_edit" => site_url('msiswa/edit'),
            "url_delete" => site_url('msiswa/remove'),
        );
        $this->load->view('m_siswa/home', $data);
        $this->load->view('m_siswa/confirm_delete', $data);
    }

    public function grid() {
        echo json_encode(array(
            "data" => $this->modsiswa->getGridData()->result()
        ));
    }

    function add() {
        $data['default']['nis'] = '';
        $data['default']['nama'] = '';
        $data['default']['alamat'] = '';
        $data['default']['hobi'] = '';
        
       $resultagama = $this->modsiswa->data_agama();
       $i = 0;
        foreach ($resultagama as $rowagama) {            
            $data['default']['agama_id'][-1]['value'] = NULL;
            $data['default']['agama_id'][-1]['display'] = '- Please Select -';
            $data['default']['agama_id'][$i]['value'] = $rowagama['agama_id'];
            $data['default']['agama_id'][$i]['display'] = $rowagama['nama'];
            $i++;
        } 
       $resultjurusan = $this->modsiswa->data_jurusan();
       $j = 0;
        foreach ($resultjurusan as $rowjurusan) {            
            $data['default']['jurusan_id'][-1]['value'] = NULL;
            $data['default']['jurusan_id'][-1]['display'] = '- Please Select -';
            $data['default']['jurusan_id'][$j]['value'] = $rowjurusan['jurusan_id'];
            $data['default']['jurusan_id'][$j]['display'] = $rowjurusan['nama'];
            $j++;
        } 
        
        $data['default']['nama_ayah'] = '';
        $data['default']['nama_ibu'] = '';
        $data['default']['pekerjaan_ayah'] = '';
        $data['default']['pekerjaan_ibu'] = '';
        $data['default']['nohp'] = '';
        $data['default']['email'] = '';

        $data['default']['jk'][0]['value'] = NULL;
        $data['default']['jk'][0]['display'] = '-Please Select-';
        $data['default']['jk'][1]['value'] = 'L';
        $data['default']['jk'][1]['display'] = 'Laki-laki';
        $data['default']['jk'][2]['value'] = 'P';
        $data['default']['jk'][2]['display'] = 'Perempuan';
        
        $data['url_post'] = site_url('msiswa/addpost');
        $data['url_index'] = site_url('msiswa');
        $data['id'] = 0;
       
        $this->load->view('m_siswa/form', $data);
    }

    public function addpost() {
        $this->form_validation->set_rules('nis', 'NIS', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('agama_id', 'Agama', 'required');
        $this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required');
        $this->form_validation->set_rules('tempatlahir', 'Tampat Lahir', 'required');
        $this->form_validation->set_rules('tanggallahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Ayah', 'required');
        $this->form_validation->set_rules('nama_ibu', 'Ibu', 'required');
        $this->form_validation->set_rules('nohp', 'Handphone', 'required');

        if ($this->form_validation->run() == TRUE) {
            $nis = $this->input->post('nis');
            $nama = $this->input->post('nama');
            $jk = $this->input->post('jk');
            $agama = $this->input->post('agama_id');
            $jurusan = $this->input->post('jurusan_id');
            $tempatlahir = $this->input->post('tempatlahir');
            $tanggallahir = date('Y-m-d', strtotime($this->input->post('tanggallahir')));
            $alamat = $this->input->post('alamat');
            $hobi = $this->input->post('hobi');
            $nama_ayah = $this->input->post('nama_ayah');
            $nama_ibu = $this->input->post('nama_ibu');
            $pekerjaan_ayah = $this->input->post('pekerjaan_ayah');
            $pekerjaan_ibu = $this->input->post('pekerjaan_ibu');
            $nohp = $this->input->post('nohp');
            $email = $this->input->post('email');

            $record = array(
                "nis" => $nis,
                "nama" => $nama,
                "jk" => $jk,
                "agama_id" => $agama,
                "jurusan_id" => $jurusan,
                "alamat" => $alamat,
                "tempatlahir" => $tempatlahir,
                "tanggallahir" => $tanggallahir,
                "hobi" => $hobi,
                "nama_ayah" => $nama_ayah,
                "nama_ibu" => $nama_ibu,
                "pekerjaan_ayah" => $pekerjaan_ayah,
                "pekerjaan_ibu" => $pekerjaan_ibu,
                "nohp" => $nohp,
                "email" => $email,
            );
            
            $checkdata = $this->modsiswa->checkdata($nis);
            if($checkdata > 0){
                $valid ='false';
                $message ='Data already exist';
                $err_nis ="NIS sudah ada pada master siswa";
            }else{
                $valid ='true';
                $message ='Insert data success';
                $err_nis =null;
                $this->modsiswa->insert($record);
            }
            

            $jsonmsg = array(
                "msg" => $message,
                "hasil" => $valid,
                "err_nis" => $err_nis,
                "err_jk" => null,
                "err_agama_id" => null,
                "err_jurusan_id" => null,
                "err_alamat" => null,
                "err_tanggallahir" => null,
                "err_tempatlahir" => null,
                "err_nama_ayah" => null,
                "err_nama_ibu" => null,
                "err_nohp" => null,
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Insert Data Failed',
                "hasil" => 'false',
                "err_nama" => form_error('nama'),
                "err_nis" => form_error('nis'),
                "err_jk" => form_error('jk'),
                "err_alamat" => form_error('alamat'),
                "err_nama_ayah" => form_error('nama_ayah'),
                "err_agama_id" => form_error('agama_id'),
                "err_jurusan_id" => form_error('jurusan_id'),
                "err_nama_ibu" => form_error('nama_ibu'),
                "err_tanggallahir" => form_error('tanggallahir'),
                "err_tempatlahir" => form_error('tempatlahir'),
                "err_nohp" => form_error('nohp'),
            );
        }
        echo json_encode($jsonmsg);
    }

    function edit($id) {
        $row = $this->modsiswa->getby_id($id)->row();
        $resultagama = $this->modsiswa->data_agama();
        
        $data['default']['nis'] = $row->nis;
        $data['default']['nama'] = $row->nama;
        $data['default']['alamat'] = $row->alamat;
        $data['default']['hobi'] = $row->hobi;
         
       $i = 0;
        foreach ($resultagama as $rowagama) {       
            $data['default']['agama_id'][$i]['value'] = $rowagama['agama_id'];
            $data['default']['agama_id'][$i]['display'] = $rowagama['nama'];
             if ($row->agama_id == $rowagama['agama_id']) {
                $data['default']['agama_id'][$i]['selected'] = "SELECTED";
            }
            $i++;
        }
         $resultjurusan = $this->modsiswa->data_jurusan();
       $j = 0;
        foreach ($resultjurusan as $rowjurusan) {    
            $data['default']['jurusan_id'][$j]['value'] = $rowjurusan['jurusan_id'];
            $data['default']['jurusan_id'][$j]['display'] = $rowjurusan['nama'];
             if ($row->jurusan_id == $rowjurusan['jurusan_id']) {
                $data['default']['jurusan_id'][$j]['selected'] = "SELECTED";
            }
            $j++;
        } 
        
        $data['default']['nama_ayah'] = $row->nama_ayah;
        $data['default']['nama_ibu'] = $row->nama_ibu;
        $data['default']['tempatlahir'] = $row->tempatlahir;
        $data['default']['tanggallahir'] = date('d-m-Y', strtotime($row->tanggallahir));
        $data['default']['pekerjaan_ayah'] = $row->pekerjaan_ayah;
        $data['default']['pekerjaan_ibu'] = $row->pekerjaan_ibu;
        $data['default']['nohp'] = $row->nohp;
        $data['default']['email'] = $row->email;

        $data['default']['jk'][0]['value'] = NULL;
        $data['default']['jk'][0]['display'] = '-Please Select-';
        $data['default']['jk'][1]['value'] = 'L';
        $data['default']['jk'][1]['display'] = 'Laki-laki';
        $data['default']['jk'][2]['value'] = 'P';
        $data['default']['jk'][2]['display'] = 'Perempuan';
        if ($row->jk == 'L') {
            $data['default']['jk'][1]['selected'] = "SELECTED";
        } else if ($row->jk == 'P') {
            $data['default']['jk'][2]['selected'] = "SELECTED";
        } else {
            $data['default']['jk'][0]['selected'] = "SELECTED";
        }
        
        $data['url_post'] = site_url('msiswa/editpost');
        $data['url_index'] = site_url('msiswa');
        $data['id'] = $id;
        $this->load->view('m_siswa/form', $data);
    }

    function editpost() {
        $this->form_validation->set_rules('nis', 'NIS', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('agama_id', 'Agama', 'required');
        $this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Ayah', 'required');
        $this->form_validation->set_rules('nama_ibu', 'Ibu', 'required');
        $this->form_validation->set_rules('nohp', 'Handphone', 'required');
        $this->form_validation->set_rules('tempatlahir', 'Tampat Lahir', 'required');
        $this->form_validation->set_rules('tanggallahir', 'Tanggal Lahir', 'required');

        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id');
            $nis = $this->input->post('nis');
            $agama_id = $this->input->post('agama_id');
            $jurusan_id = $this->input->post('jurusan_id');
            $nama = $this->input->post('nama');
            $jk = $this->input->post('jk');
            $alamat = $this->input->post('alamat');
            $tempatlahir = $this->input->post('tempatlahir');
            $tanggallahir = date('Y-m-d', strtotime($this->input->post('tanggallahir')));
            $hobi = $this->input->post('hobi');
            $nama_ayah = $this->input->post('nama_ayah');
            $nama_ibu = $this->input->post('nama_ibu');
            $pekerjaan_ayah = $this->input->post('pekerjaan_ayah');
            $pekerjaan_ibu = $this->input->post('pekerjaan_ibu');
            $nohp = $this->input->post('nohp');
            $email = $this->input->post('email');

            $record = array(
                "nis" => $nis,
                "nama" => $nama,
                "jk" => $jk,
                "agama_id" => $agama_id,
                "jurusan_id" => $jurusan_id,
                "alamat" => $alamat,
                "hobi" => $hobi,
                "tempatlahir" => $tempatlahir,
                "tanggallahir" => $tanggallahir,
                "nama_ayah" => $nama_ayah,
                "nama_ibu" => $nama_ibu,
                "pekerjaan_ayah" => $pekerjaan_ayah,
                "pekerjaan_ibu" => $pekerjaan_ibu,
                "nohp" => $nohp,
                "email" => $email,
            );
            
       
            $this->modsiswa->update($id, $record);

            $jsonmsg = array(
                "msg" => 'Update Data Success',
                "hasil" => 'true',
                "err_nis" => null,
                "err_jk" => null,
                "err_alamat" => null,
                "err_nama_ayah" => null,
                "err_nama_ibu" => null,
                "err_nohp" => null,
                "err_agama_id" => null,
                "err_jurusan_id" => null,
                "err_tanggallahir" => null,
                "err_tempatlahir" => null,
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Update Data Failed',
                "hasil" => 'false',
                "err_nama" => form_error('nama'),
                "err_nis" => form_error('nis'),
                "err_jk" => form_error('jk'),
                "err_alamat" => form_error('alamat'),
                 "err_agama_id" => form_error('agama_id'),
                 "err_jurusan_id" => form_error('jurusan_id'),
                "err_nama_ayah" => form_error('nama_ayah'),
                "err_nama_ibu" => form_error('nama_ibu'),
                "err_nohp" => form_error('nohp'),
                "err_tanggallahir" => form_error('tanggallahir'),
                "err_tempatlahir" => form_error('tempatlahir'),
            );
        }
        echo json_encode($jsonmsg);
    }

    public function remove() {
        $id = $this->input->post('siswa_id');
        $this->modsiswa->delete($id);
        $jsonmsg = array(
            "msg" => 'Delete Data Succces',
            "hasil" => false
        );
        echo json_encode($jsonmsg);
    }

}
