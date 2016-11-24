<?php

class Login_model extends CI_Model {

    private $table;
    private $m_guru;
    private $m_kelas;
    private $m_siswa;
    private $m_tahunajaran;

    public function __construct() {
        parent::__construct();
        $this->table = "m_userlogin";
        $this->m_kelas = "m_kelas";
        $this->m_guru = "m_guru";
        $this->m_siswa = "m_siswa";
        $this->m_tahunajaran = "m_tahunajaran";
        $this->m_matpel = "m_matapelajaran";
    }

    public function data_kelas() {
        return $this->db->get($this->m_kelas)->result_array();
    }

    public function data_siswa() {
        return $this->db->get($this->m_siswa)->result_array();
    }

    public function data_guru() {
        return $this->db->get($this->m_guru)->result_array();
    }

    public function data_tahunajaran() {
        return $this->db->get($this->m_tahunajaran)->result_array();
    }

    public function data_matapelajaran() {
        return $this->db->get($this->m_matpel)->result_array();
    }

    function insert($record) {
        $this->db->insert($this->table, $record);
    }

    function getby_id($id) {
        $this->db->where("userlogin", $id);
        return $this->db->get($this->table);
    }

    function update($id, $record) {
        $this->db->where("userlogin", $id);
        $this->db->update($this->table, $record);
    }

    function delete($id) {
        $this->db->delete($this->table, array("userlogin" => $id)
        );
    }

}
