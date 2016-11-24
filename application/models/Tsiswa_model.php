<?php

class Tsiswa_model extends CI_Model {
    private $table;
    private $m_guru;
    private $m_kelas;
    private $m_siswa;

    public function __construct() {
        parent::__construct();
        $this->table = "data_siswa";
        $this->m_kelas = "m_kelas";
        $this->m_guru = "m_guru";
        $this->m_siswa = "m_siswa";
        $this->m_tahunajaran = "m_tahunajaran";
    }
    
    public function data_kelas(){
        return $this->db->get($this->m_kelas)->result_array();
    }
    public function data_siswa(){
        return $this->db->get($this->m_siswa)->result_array();
    }
    public function data_guru(){
        return $this->db->get($this->m_guru)->result_array();
    }
   
    public function data_tahunajaran(){
        return $this->db->get($this->m_tahunajaran)->result_array();
    }
   

    public function getAll() {
        $sql =" 
                SELECT
                    a.*,
                    b.nama as walikelas,b.nip,
                    c.nama as nama_kelas,
                    d.*,
                    e.nama as tahunajaran
               FROM $this->table a
               LEFT JOIN $this->m_guru b ON b.guru_id = a.walikelas_id      
               LEFT JOIN $this->m_siswa d ON d.siswa_id = a.siswa_id      
               LEFT JOIN $this->m_kelas c ON c.kelas_id = a.kelas_id      
               LEFT JOIN $this->m_tahunajaran e ON e.tahunajaran_id = a.tahunajaran_id      
                
               "; 
        return $this->db->query($sql);
    }

    function checkData($p1,$p2,$p3){
        $this->db->where("siswa_id",$p1);
        $this->db->where("kelas_id",$p2);
        $this->db->where("tahunajaran_id",$p3);
        return $this->db->get($this->table)->num_rows();     
    }
    
    function getGridData() {
        $query = "
                SELECT
                    a.*,
                    b.nama as walikelas,b.nip,
                    c.nama as nama_kelas,
                    d.*,
                    e.nama as tahunajaran
                FROM $this->table a
                LEFT JOIN $this->m_guru b ON b.guru_id = a.walikelas_id      
                LEFT JOIN $this->m_kelas c ON c.kelas_id = a.kelas_id     
                LEFT JOIN $this->m_siswa d ON d.siswa_id = a.siswa_id   
                LEFT JOIN $this->m_tahunajaran e ON e.tahunajaran_id = a.tahunajaran_id 
                 ";
        return $this->db->query($query);      
    }
  
    function insert($record) {
        $this->db->insert($this->table, $record);
    }

    function getby_id($id) {
        $this->db->where("datasiswa_id", $id);
        return $this->db->get($this->table);
    }

    function update($id, $record) {
        $this->db->where("datasiswa_id", $id);
        $this->db->update($this->table, $record);
    }

    function delete($id) {
        $this->db->delete($this->table, array("datasiswa_id" => $id)
        );
    }

}
