<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mjurusan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mjurusan_model', 'jurusan');
    }

    public function index() {
        $data = array(
            "base" => base_url(),
            "url_grid" => site_url('mjurusan/grid'),
            "url_add" => site_url('mjurusan/add'),
            "url_edit" => site_url('mjurusan/edit'),
            "url_delete" => site_url('mjurusan/remove'),
        );
        $this->load->view('m_jurusan/home', $data);
        $this->load->view('m_jurusan/confirm_delete', $data);
    }

    public function grid() {
        echo json_encode(array(
            "data" => $this->jurusan->getGridData()->result()
        ));
    }

    function add() {
        $data['default']['nama'] = '';
        $data['url_post'] = site_url('mjurusan/addpost');
        $data['url_index'] = site_url('mjurusan');
        $data['id'] = 0;

        $this->load->view('m_jurusan/form', $data);
    }

    public function addpost() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->form_validation->run() == TRUE) {
            $nama = $this->input->post('nama');

            $record = array(
                "nama" => $nama,
            );

            $checkdata = $this->jurusan->checkdata($nama);
            if ($checkdata > 0) {
                $valid = 'false';
                $message = 'data already exist';
                $err_name = "Name Jurusan sudah ada";
            } else {
                $this->jurusan->insert($record);
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
        $row = $this->jurusan->getby_id($id)->row();
        $data['default']['nama'] = $row->nama;

        $data['url_post'] = site_url('mjurusan/editpost');
        $data['url_index'] = site_url('mjurusan');
        $data['id'] = $id;
        $this->load->view('m_jurusan/form', $data);
    }

    function editpost() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');

            $record = array(
                "nama" => $nama,
            );


            $this->jurusan->update($id, $record);

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
        $id = $this->input->post('jurusan_id');
        $this->jurusan->delete($id);
        $jsonmsg = array(
            "msg" => 'Delete Data Succces',
            "hasil" => true
        );
        echo json_encode($jsonmsg);
    }

}
