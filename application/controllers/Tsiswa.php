<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tsiswa extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Tsiswa_model', 'modtsiswa');
    }

    public function index() {
        $data = array(
            "url_grid" => site_url('tsiswa/grid'),
            "url_add" => site_url('tsiswa/add'),
            "url_getdata" => site_url('tsiswa/getdata'),
            "url_edit" => site_url('tsiswa/edit'),
            "url_delete" => site_url('tsiswa/remove'),
        );
        $this->load->view('t_siswa/home', $data);
        $this->load->view('t_siswa/confirm_delete', $data);
        
    }

    public function grid() {
        echo json_encode(array(
            "data" => $this->modtsiswa->getGridData()->result()
        ));
    }
 function add() {
        $resultsiswa = $this->modtsiswa->data_siswa();
        $resultguru = $this->modtsiswa->data_guru();
        $resultkelas = $this->modtsiswa->data_kelas();
        $resulttahunajaran = $this->modtsiswa->data_tahunajaran();
        
        $i = 0;
        foreach ($resultsiswa as $rowsiswa) {            
            $data['default']['siswa_id'][-1]['value'] = NULL;
            $data['default']['siswa_id'][-1]['display'] = '- Please Select -';
            $data['default']['siswa_id'][$i]['value'] = $rowsiswa['siswa_id'];
            $data['default']['siswa_id'][$i]['display'] = $rowsiswa['nama'];
            $i++;
        } 
        $j = 0;
        foreach ($resultkelas as $rowkelas) {            
            $data['default']['kelas_id'][-1]['value'] = NULL;
            $data['default']['kelas_id'][-1]['display'] = '- Please Select -';
            $data['default']['kelas_id'][$j]['value'] = $rowkelas['kelas_id'];
            $data['default']['kelas_id'][$j]['display'] = $rowkelas['nama'];
            $j++;
        } 
        $k = 0;
        foreach ($resultguru as $rowguru) {            
            $data['default']['guru_id'][-1]['value'] = NULL;
            $data['default']['guru_id'][-1]['display'] = '- Please Select -';
            $data['default']['guru_id'][$k]['value'] = $rowguru['guru_id'];
            $data['default']['guru_id'][$k]['display'] = $rowguru['nama'];
            $k++;
        } 
        $l = 0;
        foreach ($resulttahunajaran as $rowtahunajaran) {            
            $data['default']['tahunajaran_id'][-1]['value'] = NULL;
            $data['default']['tahunajaran_id'][-1]['display'] = '- Please Select -';
            $data['default']['tahunajaran_id'][$l]['value'] = $rowtahunajaran['tahunajaran_id'];
            $data['default']['tahunajaran_id'][$l]['display'] = $rowtahunajaran['nama'];
            $l++;
        } 
     
        
        $data['url_post'] = site_url('tsiswa/addpost');
        $data['url_index'] = site_url('tsiswa');
        $data['id'] = 0;       
        $this->load->view('t_siswa/form', $data);
    }
 

    public function addpost() {
        $this->form_validation->set_rules('siswa_id', 'Siswa', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
        $this->form_validation->set_rules('guru_id', 'Guru', 'required');
        $this->form_validation->set_rules('tahunajaran_id', 'Tahun ajaran', 'required');
        if ($this->form_validation->run() == TRUE) {
            $siswa = $this->input->post('siswa_id');
            $kelas = $this->input->post('kelas_id');
            $guru = $this->input->post('guru_id');
            $tahunajaran = $this->input->post('tahunajaran_id');
            
            $record = array(
                "siswa_id" => $siswa,
                "kelas_id" => $kelas,
                "walikelas_id" => $guru,
                "tahunajaran_id" => $tahunajaran,
            );
            
            
            $checkdata = $this->modtsiswa->checkData($siswa,$kelas,$tahunajaran);           
            if ($checkdata > 0) {
                $valid = 'false';
                $message = 'data already exist';
                $err_siswa = "Data siswa di kelas ini sudah ada";
            } else {
                $this->modtsiswa->insert($record);    
                $valid = 'true';
                $message = "Insert data, success";
                $err_siswa = null;
            }
            
            

            $jsonmsg = array(
                "msg" => $message,
                "hasil" => $valid,
                "err_siswa" => $err_siswa,
                "err_kelas" => null,
                "err_matpel" => null,
                "err_tahunajaran" => null
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Insert Data Failed',
                "hasil" => 'false',
                "err_siswa" => form_error('siswa_id'),
                "err_kelas" => form_error('kelas_id'),
                "err_matpel" => form_error('guru_id'),
                "err_tahunajaran" => form_error('tahunajaran_id')
            );
        }
        echo json_encode($jsonmsg);
    }
    function edit($id) {
        $row = $this->modtsiswa->getby_id($id)->row();
        $resultsiswa = $this->modtsiswa->data_siswa();
        $resultkelas = $this->modtsiswa->data_kelas();
        $resultguru = $this->modtsiswa->data_guru();
        $resulttahunajaran = $this->modtsiswa->data_tahunajaran();
        
        $i = 0;
        foreach ($resultsiswa as $rowsiswa) {    
            $data['default']['siswa_id'][$i]['value'] = $rowsiswa['siswa_id'];
            $data['default']['siswa_id'][$i]['display'] = $rowsiswa['nama'];
             if ($row->siswa_id == $rowsiswa['siswa_id']) {
                $data['default']['siswa_id'][$i]['selected'] = "SELECTED";
            }
            $i++;
        } 
        $j = 0;
        foreach ($resultkelas as $rowkelas) {
            $data['default']['kelas_id'][$j]['value'] = $rowkelas['kelas_id'];
            $data['default']['kelas_id'][$j]['display'] = $rowkelas['nama'];
              if ($row->kelas_id == $rowkelas['kelas_id']) {
                $data['default']['kelas_id'][$j]['selected'] = "SELECTED";
            }
            $j++;
        } 
        
        $k = 0;
        foreach ($resultguru as $rowguru) {     
            $data['default']['guru_id'][$k]['value'] = $rowguru['guru_id'];
            $data['default']['guru_id'][$k]['display'] = $rowguru['nama'];
             if ($row->walikelas_id == $rowguru['guru_id']) {
                $data['default']['guru_id'][$k]['selected'] = "SELECTED";
            }
            $k++;
        } 
        
         $l = 0;
        foreach ($resulttahunajaran as $rowtahunajaran) {     
            $data['default']['tahunajaran_id'][$l]['value'] = $rowtahunajaran['tahunajaran_id'];
            $data['default']['tahunajaran_id'][$l]['display'] = $rowtahunajaran['nama'];
             if ($row->tahunajaran_id == $rowtahunajaran['tahunajaran_id']) {
                $data['default']['tahunajaran_id'][$l]['selected'] = "SELECTED";
            }
            $l++;
        } 
       
        $data['url_post'] = site_url('tsiswa/editpost');
        $data['url_index'] = site_url('tsiswa');
        $data['id'] = $id;
        $this->load->view('t_siswa/form', $data);
    }

    public function editpost() {
         $this->form_validation->set_rules('siswa_id', 'Guru', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
        $this->form_validation->set_rules('guru_id', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('tahunajaran_id', 'Tahun ajaran', 'required');
        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id');
            $siswa = $this->input->post('siswa_id');
            $kelas = $this->input->post('kelas_id');
            $guru = $this->input->post('guru_id');
            $tahunajaran = $this->input->post('tahunajaran_id');
            
            $record = array(
                "siswa_id" => $siswa,
                "kelas_id" => $kelas,
                "walikelas_id" => $guru,
                "tahunajaran_id" => $tahunajaran
            );
            $this->modtsiswa->update($id, $record);

             $jsonmsg = array(
                "msg" => 'Update Data Success',
                "hasil" => 'true',
                "err_siswa" => null,
                "err_kelas" => null,
                "err_matpel" => null,
                "err_tahunajaran" => null
            );
        } else {
            $jsonmsg = array(
                "msg" => 'Update Data Failed',
                "hasil" => 'false',
                "err_siswa" => form_error('siswa_id'),
                "err_kelas" => form_error('kelas_id'),
                "err_matpel" => form_error('guru_id'),
                "err_tahunajaran" => form_error('tahunajaran_id')
            );
        }
        echo json_encode($jsonmsg);
    }

    public function remove() {
        $id = $this->input->post('datasiswa_id');
        $this->modtsiswa->delete($id);
        $jsonmsg = array(
            "msg" => 'Delete Data Succces',
            "hasil" => false
        );
        echo json_encode($jsonmsg);
    }

}
