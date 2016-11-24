<?php

class Tguru_model extends CI_Model {
    private $table;
    private $m_guru;
    private $m_kelas;
    private $m_matpel;

    public function __construct() {
        parent::__construct();
        $this->table = "data_guru";
        $this->m_kelas = "m_kelas";
        $this->m_guru = "m_guru";
        $this->m_matpel = "m_matapelajaran";
    }
    
    public function data_kelas(){
        return $this->db->get($this->m_kelas)->result_array();
    }
    public function data_guru(){
        return $this->db->get($this->m_guru)->result_array();
    }
    public function data_matapelajaran(){
        return $this->db->get($this->m_matpel)->result_array();
    }

    public function getAll() {
        $sql =" 
                SELECT
                    a.*,
                    b.nama as nama_guru,b.nip,
                    c.nama as nama_kelas,
                    d.nama as nama_matapelajaran                   
               FROM $this->table a
               LEFT JOIN $this->m_guru b ON b.guru_id = a.guru_id      
               LEFT JOIN $this->m_kelas c ON c.kelas_id = a.kelas_id      
               LEFT JOIN $this->m_matpel d ON d.matapelajaran_id = a.matapelajaran_id      
                
               "; 
        return $this->db->query($sql);
    }

    function checkData($p1,$p2,$p3){
        $this->db->where("guru_id",$p1);
        $this->db->where("kelas_id",$p2);
        $this->db->where("matapelajaran_id",$p3);
        return $this->db->get($this->table)->num_rows();     
    }
    
    function getGridData() {
        $query = "
                SELECT
                    a.*,
                    b.nama as nama_guru,b.nip,
                    c.nama as nama_kelas,
                    d.nama as nama_matapelajaran                   
                FROM $this->table a
                LEFT JOIN $this->m_guru b ON b.guru_id = a.guru_id      
                LEFT JOIN $this->m_kelas c ON c.kelas_id = a.kelas_id      
                LEFT JOIN $this->m_matpel d ON d.matapelajaran_id = a.matapelajaran_id   
                 ";
        return $this->db->query($query);      
    }
  
    function insert($record) {
        $this->db->insert($this->table, $record);
    }

    function getby_id($id) {
        $this->db->where("dataguru_id", $id);
        return $this->db->get($this->table);
    }

    function update($id, $record) {
        $this->db->where("dataguru_id", $id);
        $this->db->update($this->table, $record);
    }

    function delete($id) {
        $this->db->delete($this->table, array("dataguru_id" => $id)
        );
    }

}
