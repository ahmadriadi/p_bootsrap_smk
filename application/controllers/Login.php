<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'login');
    }

    public function index() {

        $resultkelas = $this->login->data_kelas();
        $resultmatpel = $this->login->data_matapelajaran();
        $resulttahunajaran = $this->login->data_tahunajaran();

        $data['default']['loginas'][0]['value'] = NULL;
        $data['default']['loginas'][0]['display'] = 'Pilih sebagai';
        $data['default']['loginas'][1]['value'] = '1';
        $data['default']['loginas'][1]['display'] = 'Administrator';
        $data['default']['loginas'][2]['value'] = '2';
        $data['default']['loginas'][2]['display'] = 'Guru';
        $data['default']['loginas'][3]['value'] = '3';
        $data['default']['loginas'][3]['display'] = 'Siswa';

        $j = 0;
        foreach ($resultkelas as $rowkelas) {
            $data['default']['kelas_id'][-1]['value'] = NULL;
            $data['default']['kelas_id'][-1]['display'] = '- Please Select -';
            $data['default']['kelas_id'][$j]['value'] = $rowkelas['kelas_id'];
            $data['default']['kelas_id'][$j]['display'] = $rowkelas['nama'];
            $j++;
        }
        $k = 0;
        foreach ($resultmatpel as $rowmatpel) {
            $data['default']['matapelajaran_id'][-1]['value'] = NULL;
            $data['default']['matapelajaran_id'][-1]['display'] = '- Please Select -';
            $data['default']['matapelajaran_id'][$k]['value'] = $rowmatpel['matapelajaran_id'];
            $data['default']['matapelajaran_id'][$k]['display'] = $rowmatpel['nama'];
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

        $data['url_post'] = site_url('login/verifydata');
        $this->load->view('admin/login', $data);
    }
    
    function verifydata(){
        
    }

}
