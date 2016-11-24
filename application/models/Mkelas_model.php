<?php

class Mkelas_model extends CI_Model {
    private $table;

    public function __construct() {
        parent::__construct();
        $this->table = "m_kelas";
    }

    public function getAll() {
        $sql = "SELECT*FROM $this->table ORDER BY nama ASC";
        return $this->db->query($sql);
    }

    function checkData($param){
        $this->db->where("nama",$param);
        return $this->db->get($this->table);     
    }
    
    function getGridData() {
        $query = "
                 SELECT a.*                        
                 FROM $this->table a   
                 ";
        return $this->db->query($query);      
    }
  
    function insert($record) {
        $this->db->insert($this->table, $record);
    }

    function getby_id($id) {
        $this->db->where("kelas_id", $id);
        return $this->db->get($this->table);
    }

    function update($id, $record) {
        $this->db->where("kelas_id", $id);
        $this->db->update($this->table, $record);
    }

    function delete($id) {
        $this->db->delete($this->table, array("kelas_id" => $id)
        );
    }

}
