<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mguru extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mguru_model', 'modguru');
    }

    public function index() {
        $data = array(
            "base" => base_url(),
            "url_grid" => site_url('mguru/grid'),
            "url_add" => site_url('mguru/add'),
            "url_edit" => site_url('mguru/edit'),
            "url_delete" => site_url('mguru/remove'),
        );
        $this->load->view('m_guru/home', $data);
        $this->load->view('m_guru/confirm_delete', $data);
    }

    public function grid() {
        echo json_encode(array(
            "data" => $this->modguru->getGridData()->result()
        ));
    }

    function add() {
        $data['default']['nip'] = '';
        $data['default']['nama'] = '';
        $data['default']['alamat'] = '';
        $data['default']['hobi'] = '';
        
       $resultagama = $this->modguru->data_agama();
       $i = 0;
        foreach ($resultagama as $rowagama) {            
            $data['default']['agama_id'][-1]['value'] = NULL;
            $data['default']['agama_id'][-1]['display'] = '- Please Select -';
            $data['default']['agama_id'][$i]['value'] = $rowagama['agama_id'];
            $data['default']['agama_id'][$i]['display'] = $rowagama['nama'];
            $i++;
        } 
        
     
        $data['default']['nohp'] = '';
        $data['default']['email'] = '';

        $data['default']['jk'][0]['value'] = NULL;
        $data['default']['jk'][0]['display'] = '-Please Select-';
        $data['default']['jk'][1]['value'] = 'L';
        $data['default']['jk'][1]['display'] = 'Laki-laki';
        $data['default']['jk'][2]['value'] = 'P';
        $data['default']['jk'][2]['display'] = 'Perempuan';
        
        $data['url_post'] = site_url('mguru/addpost');
        $data['url_index'] = site_url('mguru');
        $data['id'] = 0;
       
        $this->load->view('m_guru/form', $data);
    }

    public function addpost() {
        $this->form_validation->set_rules('nip', 'NIS', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jk', 'Jenip Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('agama_id', 'Agama', 'required');
        $this->form_validation->set_rules('tempatlahir', 'Tampat Lahir', 'required');
        $this->form_validation->set_rules('tanggallahir', 'Tanggal Lahir', 'required');      
        $this->form_validation->set_rules('nohp', 'Handphone', 'required');

        if ($this->form_validation->run() == TRUE) {
            $nip = $this->input->post('nip');
            $nama = $this->input->post('nama');
            $jk = $this->input->post('jk');
            $agama = $this->input->post('agama_id');
            $tempatlahir = $this->input->post('tempatlahir');
            $tanggallahir = date('Y-m-d', strtotime($this->input->post('tanggallahir')));
            $alamat = $this->input->post('alamat');
            $nohp = $this->input->post('nohp');
            $email = $this->input->post('email');

            $record = array(
                "nip" => $nip,
                "nama" => $nama,
                "jk" => $jk,
                "agama_id" => $agama,
                "alamat" => $alamat,
                "tempatlahir" => $tempatlahir,
                "tanggallahir" => $tanggallahir,
                "nohp" => $nohp,
                "email" => $email,
            );
            
            $checkdata = $this->modguru->checkdata($nip);
            if($checkdata > 0){
                $valid ='false';
                $message ='Data already exist';
                $err_nip ="NIP sudah ada pada master guru";
            }else{
                $valid ='true';
                $message ='Insert data success';
                $err_nip =null;
                $this->modguru->insert($record);
            }
            

            $jsonmsg = array(
                "msg" => $message,
                "hasil" => $valid,
                "err_nip" => $err_nip,
                "err_jk" => null,
                "err_agama_id" => null,
                "err_alamat" => null,
                "err_tanggallahir" => null,
                "err_tempatlahir" => null,           
                "err_nohp" => null,
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Insert Data Failed',
                "hasil" => 'false',
                "err_nama" => form_error('nama'),
                "err_nip" => form_error('nip'),
                "err_jk" => form_error('jk'),
                "err_alamat" => form_error('alamat'),
                "err_agama_id" => form_error('agama_id'),
                "err_tanggallahir" => form_error('tanggallahir'),
                "err_tempatlahir" => form_error('tempatlahir'),
                "err_nohp" => form_error('nohp'),
            );
        }
        echo json_encode($jsonmsg);
    }

    function edit($id) {
        $row = $this->modguru->getby_id($id)->row();
        $resultagama = $this->modguru->data_agama();
        
        $data['default']['nip'] = $row->nip;
        $data['default']['nama'] = $row->nama;
        $data['default']['alamat'] = $row->alamat;
         
       $i = 0;
        foreach ($resultagama as $rowagama) {       
            $data['default']['agama_id'][$i]['value'] = $rowagama['agama_id'];
            $data['default']['agama_id'][$i]['display'] = $rowagama['nama'];
             if ($row->agama_id == $rowagama['agama_id']) {
                $data['default']['agama_id'][$i]['selected'] = "SELECTED";
            }
            $i++;
        } 
     
        $data['default']['tempatlahir'] = $row->tempatlahir;
        $data['default']['tanggallahir'] = date('d-m-Y', strtotime($row->tanggallahir));
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
        
        $data['url_post'] = site_url('mguru/editpost');
        $data['url_index'] = site_url('mguru');
        $data['id'] = $id;
        $this->load->view('m_guru/form', $data);
    }

    function editpost() {
        $this->form_validation->set_rules('nip', 'NIS', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jk', 'Jenip Kelamin', 'required');
        $this->form_validation->set_rules('agama_id', 'Agama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nohp', 'Handphone', 'required');
        $this->form_validation->set_rules('tempatlahir', 'Tampat Lahir', 'required');
        $this->form_validation->set_rules('tanggallahir', 'Tanggal Lahir', 'required');

        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id');
            $nip = $this->input->post('nip');
            $agama_id = $this->input->post('agama_id');
            $nama = $this->input->post('nama');
            $jk = $this->input->post('jk');
            $alamat = $this->input->post('alamat');
            $tempatlahir = $this->input->post('tempatlahir');
            $tanggallahir = date('Y-m-d', strtotime($this->input->post('tanggallahir')));
            $nohp = $this->input->post('nohp');
            $email = $this->input->post('email');

            $record = array(
                "nip" => $nip,
                "nama" => $nama,
                "jk" => $jk,
                "agama_id" => $agama_id,
                "alamat" => $alamat,
                "tempatlahir" => $tempatlahir,
                "tanggallahir" => $tanggallahir,               
                "nohp" => $nohp,
                "email" => $email,
            );
            
       
            $this->modguru->update($id, $record);

            $jsonmsg = array(
                "msg" => 'Update Data Success',
                "hasil" => 'true',
                "err_nip" => null,
                "err_jk" => null,
                "err_alamat" => null,              
                "err_nohp" => null,
                "err_agama_id" => null,
                "err_tanggallahir" => null,
                "err_tempatlahir" => null,
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Update Data Failed',
                "hasil" => 'false',
                "err_nama" => form_error('nama'),
                "err_nip" => form_error('nip'),
                "err_jk" => form_error('jk'),
                "err_alamat" => form_error('alamat'),
                "err_agama_id" => form_error('agama_id'),              
                "err_nohp" => form_error('nohp'),
                "err_tanggallahir" => form_error('tanggallahir'),
                "err_tempatlahir" => form_error('tempatlahir'),
            );
        }
        echo json_encode($jsonmsg);
    }

    public function remove() {
        $id = $this->input->post('guru_id');
        $this->modguru->delete($id);
        $jsonmsg = array(
            "msg" => 'Delete Data Succces',
            "hasil" => false
        );
        echo json_encode($jsonmsg);
    }

}
