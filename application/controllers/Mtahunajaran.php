<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mtahunajaran extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mtahunajaran_model', 'tahunajaran');
    }

    public function index() {
        $data = array(
            "base" => base_url(),
            "url_grid" => site_url('mtahunajaran/grid'),
            "url_add" => site_url('mtahunajaran/add'),
            "url_edit" => site_url('mtahunajaran/edit'),
            "url_delete" => site_url('mtahunajaran/remove'),
        );
        $this->load->view('m_tahunajaran/home', $data);
        $this->load->view('m_tahunajaran/confirm_delete', $data);
    }

    public function grid() {
        echo json_encode(array(
            "data" => $this->tahunajaran->getGridData()->result()
        ));
    }

    function add() {
        $data['default']['nama'] = '';
        $data['url_post'] = site_url('mtahunajaran/addpost');
        $data['url_index'] = site_url('mtahunajaran');
        $data['id'] = 0;

        $this->load->view('m_tahunajaran/form', $data);
    }

    public function addpost() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->form_validation->run() == TRUE) {
            $nama = $this->input->post('nama');

            $record = array(
                "nama" => $nama,
            );

            $checkdata = $this->tahunajaran->checkdata($nama);
            if ($checkdata > 0) {
                $valid = 'false';
                $message = 'data already exist';
                $err_name = "Name Tahun aja sudah ada";
            } else {
                $this->tahunajaran->insert($record);
                $valid = 'true';
                $message = "Insert data, success";
                $err_name = null;
            }

            $jsonmsg = array(
                "msg" => $message,
                "hasil" => $valid,
                "err_nama" => $err_name,
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
        $row = $this->tahunajaran->getby_id($id)->row();
        $data['default']['nama'] = $row->nama;

        $data['url_post'] = site_url('mtahunajaran/editpost');
        $data['url_index'] = site_url('mtahunajaran');
        $data['id'] = $id;
        $this->load->view('m_tahunajaran/form', $data);
    }

    function editpost() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');

            $record = array(
                "nama" => $nama,
            );

            $this->tahunajaran->update($id, $record);

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
        $id = $this->input->post('tahunajaran_id');
        $this->tahunajaran->delete($id);
        $jsonmsg = array(
            "msg" => 'Delete Data Succces',
            "hasil" => true
        );
        echo json_encode($jsonmsg);
    }

}
