<?php

class Msiswa_model extends CI_Model {
    private $table;

    public function __construct() {
        parent::__construct();
        $this->table = "m_siswa";
        $this->m_agama = "m_agama";
        $this->m_jurusan = "m_jurusan";
    }
    
   public function data_agama(){
        return $this->db->get($this->m_agama)->result_array();
    }
   public function data_jurusan(){
        return $this->db->get($this->m_jurusan)->result_array();
    }

    public function getAll() {
        $sql = "SELECT*FROM $this->table ORDER BY nama ASC";
        return $this->db->query($sql);
    }

    function checkData($param){
        $this->db->where("nis",$param);
        return $this->db->get($this->table)->num_rows();     
    }
    
    function getGridData() {
        $query = "
                 SELECT a.*,b.nama as agama,c.nama as jurusan                        
                 FROM $this->table a   
                 LEFT JOIN $this->m_agama b ON b.agama_id = a.agama_id   
                 LEFT JOIN $this->m_jurusan c ON c.jurusan_id = a.jurusan_id   
                 ";
        return $this->db->query($query);      
    }
  
    function insert($record) {
        $this->db->insert($this->table, $record);
    }

    function getby_id($id) {
        $this->db->where("siswa_id", $id);
        return $this->db->get($this->table);
    }

    function update($id, $record) {
        $this->db->where("siswa_id", $id);
        $this->db->update($this->table, $record);
    }

    function delete($id) {
        $this->db->delete($this->table, array("siswa_id" => $id)
        );
    }

}
