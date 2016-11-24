<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mpelajaran extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mmataperlajaran_model', 'matpel');
    }

    public function index() {
        $data = array(
            "base" => base_url(),
            "url_grid" => site_url('mpelajaran/grid'),
            "url_add" => site_url('mpelajaran/add'),
            "url_edit" => site_url('mpelajaran/edit'),
            "url_delete" => site_url('mpelajaran/remove'),
        );
        $this->load->view('m_pelajaran/home', $data);
        $this->load->view('m_pelajaran/confirm_delete', $data);
    }
     public function grid() {
        echo json_encode(array(
            "data" => $this->matpel->getGridData()->result()
        ));
    }
    
    function add() {
        $data['default']['nama'] = '';        
        $data['url_post'] = site_url('mpelajaran/addpost');
        $data['url_index'] = site_url('mpelajaran');
        $data['id'] = 0;
        
        $this->load->view('m_pelajaran/form', $data);
    }
    public function addpost() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->form_validation->run() == TRUE) {
            $nama = $this->input->post('nama');
           
            $record = array(
                "nama" => $nama,               
            );
            $this->matpel->insert($record);
            $checkdata = $this->matpel->checkdata($nama);

            $jsonmsg = array(
                "msg" => 'Insert Data Success',
                "hasil" => 'true',
                "err_nama" => null,               
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Insert Data Failed',
                "hasil" => 'false',
                "err_nama" => form_error('nama'),               
            );
        }
        echo json_encode($jsonmsg);
    }
    
      function edit($id) {
        $row = $this->matpel->getby_id($id)->row();
        $data['default']['nama'] = $row->nama;
       
        $data['url_post'] = site_url('mpelajaran/editpost');
        $data['url_index'] = site_url('mpelajaran');
        $data['id'] = $id;
        $this->load->view('m_pelajaran/form', $data);
    }

    function editpost() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');       
        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id');          
            $nama = $this->input->post('nama');
            
            $record = array(
                "nama" => $nama,
               
            );
            
       
            $this->matpel->update($id, $record);

            $jsonmsg = array(
                "msg" => 'Update Data Success',
                "hasil" => 'true',
                "err_nama" => null,              
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Update Data Failed',
                "hasil" => 'false',
                "err_nama" => form_error('nama'),              
            );
        }
        echo json_encode($jsonmsg);
    }
     public function remove() {
        $id = $this->input->post('matapelajaran_id');
        $this->matpel->delete($id);
        $jsonmsg = array(
            "msg" => 'Delete Data Succces',
            "hasil" => true
        );
        echo json_encode($jsonmsg);
    }

}
