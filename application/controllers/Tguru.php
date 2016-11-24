<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tguru extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Tguru_model', 'modtguru');
    }

    public function index() {
        $data = array(
            "url_grid" => site_url('tguru/grid'),
            "url_add" => site_url('tguru/add'),
            "url_getdata" => site_url('tguru/getdata'),
            "url_edit" => site_url('tguru/edit'),
            "url_delete" => site_url('tguru/remove'),
        );
        $this->load->view('t_guru/home', $data);
        $this->load->view('t_guru/confirm_delete', $data);
        
    }

    public function grid() {
        echo json_encode(array(
            "data" => $this->modtguru->getGridData()->result()
        ));
    }
 function add() {
        $resultguru = $this->modtguru->data_guru();
        $resultkelas = $this->modtguru->data_kelas();
        $resultmatpel = $this->modtguru->data_matapelajaran();
        
        $i = 0;
        foreach ($resultguru as $rowguru) {            
            $data['default']['guru'][-1]['value'] = NULL;
            $data['default']['guru'][-1]['display'] = '- Please Select -';
            $data['default']['guru'][$i]['value'] = $rowguru['guru_id'];
            $data['default']['guru'][$i]['display'] = $rowguru['nama'];
            $i++;
        } 
        $j = 0;
        foreach ($resultkelas as $rowkelas) {            
            $data['default']['kelas'][-1]['value'] = NULL;
            $data['default']['kelas'][-1]['display'] = '- Please Select -';
            $data['default']['kelas'][$j]['value'] = $rowkelas['kelas_id'];
            $data['default']['kelas'][$j]['display'] = $rowkelas['nama'];
            $j++;
        } 
        $k = 0;
        foreach ($resultmatpel as $rowmatpel) {            
            $data['default']['matpel'][-1]['value'] = NULL;
            $data['default']['matpel'][-1]['display'] = '- Please Select -';
            $data['default']['matpel'][$k]['value'] = $rowmatpel['matapelajaran_id'];
            $data['default']['matpel'][$k]['display'] = $rowmatpel['nama'];
            $k++;
        } 
     
        
        $data['url_post'] = site_url('tguru/addpost');
        $data['url_index'] = site_url('tguru');
        $data['id'] = 0;       
        $this->load->view('t_guru/form', $data);
    }
 

    public function addpost() {
        $this->form_validation->set_rules('guru', 'Guru', 'required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('matpel', 'Mata Pelajaran', 'required');
        if ($this->form_validation->run() == TRUE) {
            $guru = $this->input->post('guru');
            $kelas = $this->input->post('kelas');
            $matpel = $this->input->post('matpel');
            
            $record = array(
                "guru_id" => $guru,
                "kelas_id" => $kelas,
                "matapelajaran_id" => $matpel,
            );
            
            
            $checkdata = $this->modtguru->checkData($guru,$kelas,$matpel);           
            if ($checkdata > 0) {
                $valid = 'false';
                $message = 'data already exist';
                $err_guru = "Data guru di kelas dan pelajaran ini sudah ada";
            } else {
                $this->modtguru->insert($record);    
                $valid = 'true';
                $message = "Insert data, success";
                $err_guru = null;
            }
            
            

            $jsonmsg = array(
                "msg" => $message,
                "hasil" => $valid,
                "err_guru" => $err_guru,
                "err_kelas" => null,
                "err_matpel" => null
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Insert Data Failed',
                "hasil" => 'false',
                "err_guru" => form_error('guru'),
                "err_kelas" => form_error('kelas'),
                "err_matpel" => form_error('matpel')
            );
        }
        echo json_encode($jsonmsg);
    }
    function edit($id) {
        $row = $this->modtguru->getby_id($id)->row();
        $resultguru = $this->modtguru->data_guru();
        $resultkelas = $this->modtguru->data_kelas();
        $resultmatpel = $this->modtguru->data_matapelajaran();
        
        $i = 0;
        foreach ($resultguru as $rowguru) {    
            $data['default']['guru'][$i]['value'] = $rowguru['guru_id'];
            $data['default']['guru'][$i]['display'] = $rowguru['nama'];
             if ($row->guru_id == $rowguru['guru_id']) {
                $data['default']['guru'][$i]['selected'] = "SELECTED";
            }
            $i++;
        } 
        $j = 0;
        foreach ($resultkelas as $rowkelas) {
            $data['default']['kelas'][$j]['value'] = $rowkelas['kelas_id'];
            $data['default']['kelas'][$j]['display'] = $rowkelas['nama'];
              if ($row->kelas_id == $rowkelas['kelas_id']) {
                $data['default']['kelas'][$j]['selected'] = "SELECTED";
            }
            $j++;
        } 
        
        $k = 0;
        foreach ($resultmatpel as $rowmatpel) {     
            $data['default']['matpel'][$k]['value'] = $rowmatpel['matapelajaran_id'];
            $data['default']['matpel'][$k]['display'] = $rowmatpel['nama'];
             if ($row->matapelajaran_id == $rowmatpel['matapelajaran_id']) {
                $data['default']['matpel'][$k]['selected'] = "SELECTED";
            }
            $k++;
        } 
       
        $data['url_post'] = site_url('tguru/editpost');
        $data['url_index'] = site_url('tguru');
        $data['id'] = $id;
        $this->load->view('t_guru/form', $data);
    }

    public function editpost() {
         $this->form_validation->set_rules('guru', 'Guru', 'required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('matpel', 'Mata Pelajaran', 'required');
        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('kelas_id');
            $guru = $this->input->post('guru');
            $kelas = $this->input->post('kelas');
            $matpel = $this->input->post('matpel');
            
            $record = array(
                "guru_id" => $guru,
                "kelas_id" => $kelas,
                "matapelajaran_id" => $matpel,
            );
            $this->modtguru->update($id, $record);

             $jsonmsg = array(
                "msg" => 'Update Data Success',
                "hasil" => 'true',
                "err_guru" => null,
                "err_kelas" => null,
                "err_matpel" => null
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Update Data Failed',
                "hasil" => 'false',
                "err_guru" => form_error('guru'),
                "err_kelas" => form_error('kelas'),
                "err_matpel" => form_error('matpel')
            );
        }
        echo json_encode($jsonmsg);
    }

    public function remove() {
        $id = $this->input->post('dataguru_id');
        $this->modtguru->delete($id);
        $jsonmsg = array(
            "msg" => 'Delete Data Succces',
            "hasil" => false
        );
        echo json_encode($jsonmsg);
    }

}
