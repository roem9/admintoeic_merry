<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pengambilan_model extends CI_Model {

    public function __construct() {
        parent::__construct(); 
        // Load Pagination library
    }

    // Fetch records
    public function getData($rowno,$rowperpage) {
        
        $this->db->select('*');
        $this->db->from('pengiriman');
        $this->db->limit($rowperpage, $rowno);  
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    // Select total records
    public function getrecordCount() {
    
        $this->db->select('count(*) as allcount');
        $this->db->from('pengiriman');
        $query = $this->db->get();
        $result = $query->result_array();
    
        return $result[0]['allcount'];
    }

}

/* End of file Pengambilan_model.php */
