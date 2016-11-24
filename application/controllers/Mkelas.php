<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mkelas extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Mkelas_model', 'modkelas');
    }

    public function index() {
        $data = array(
            "url_grid" => site_url('mkelas/grid'),
            "url_add" => site_url('mkelas/add'),
            "url_getdata" => site_url('mkelas/getdata'),
            "url_edit" => site_url('mkelas/edit'),
            "url_delete" => site_url('mkelas/remove'),
        );
        $this->load->view('m_kelas/home', $data);
        $this->load->view('m_kelas/form', $data);
        $this->load->view('m_kelas/confirm_delete', $data);
        
    }

    public function grid() {
        echo json_encode(array(
            "data" => $this->modkelas->getGridData()->result()
        ));
    }

    public function getdata() {
        $id = $this->input->post('kelas_id');
        echo json_encode($this->modkelas->getby_id($id)->row());
    }

    public function add() {
        $this->form_validation->set_rules('nama', 'Kelas', 'required');
        if ($this->form_validation->run() == TRUE) {
            $nama = $this->input->post('nama');
            $record = array(
                "nama	" => $nama
            );
            $this->modkelas->insert($record);

            $jsonmsg = array(
                "msg" => 'Insert Data Success',
                "hasil" => 'true',
                "err_nama" => null
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Insert Data Failed',
                "hasil" => 'false',
                "err_nama" => form_error('nama')
            );
        }
        echo json_encode($jsonmsg);
    }

    public function edit() {
        $this->form_validation->set_rules('nama', 'Kelas', 'required');
        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('kelas_id');
            $nama = $this->input->post('nama');
            $record = array(
                "nama	" => $nama
            );
            $this->modkelas->update($id, $record);

            $jsonmsg = array(
                "msg" => 'Update Dat Success',
                "hasil" => 'true',
                "err_nama" => null
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Update Dat Failed',
                "hasil" => 'false',
                "err_nama" => form_error('nama')
            );
        }
        echo json_encode($jsonmsg);
    }

    public function remove() {
        $id = $this->input->post('kelas_id');
        $this->modkelas->delete($id);
        $jsonmsg = array(
            "msg" => 'Delete Data Succces',
            "hasil" => false
        );
        echo json_encode($jsonmsg);
    }

}
