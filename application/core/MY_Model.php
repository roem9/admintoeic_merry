<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library('Datatables', 'datatables');
        
    }

    public function add_data($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function delete_data($table, $where){
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function edit_data($table, $where, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function get_one($table, $where = "", $order = "", $by = "ASC"){
        $this->db->from($table);
        if($where)
            $this->db->where($where);
        if($order)
            $this->db->order_by($order, $by);
        return $this->db->get()->row_array();
    }

    public function get_all($table, $where = "", $order = "", $by = "ASC"){
        $this->db->from($table);
        if($where)
            $this->db->where($where);
        if($order)
            $this->db->order_by($order, $by);
        return $this->db->get()->result_array();
    }
    
    public function get_all_limit($table, $where = "", $order = "", $by = "ASC", $rowno, $rowperpage){
        $this->db->from($table);
        if($where)
            $this->db->where($where);
        if($order)
            $this->db->order_by($order, $by);

        $this->db->limit($rowperpage, $rowno);  
        
        return $this->db->get()->result_array();
    }

    public function get_all_limit_like($table, $col, $like, $where = "", $order = "", $by = "ASC", $rowno, $rowperpage){
        $this->db->from($table);
        $this->db->like($col, $like);
        if($where)
            $this->db->where($where);
        if($order)
            $this->db->order_by($order, $by);

        $this->db->limit($rowperpage, $rowno);  
        
        return $this->db->get()->result_array();
    }

    public function get_all_group_by($table, $where = "", $group = ""){
        $this->db->from($table);
        if($where)
            $this->db->where($where);
        if($group)
            $this->db->group_by($group);
        return $this->db->get()->result_array();
    }

    public function get_all_join_table($table1, $table2, $key, $where, $join="right"){
        $this->db->from($table1);
        $this->db->join($table2, "$table1.$key = $table2.$key", $join);
        if($where)
            $this->db->where($where);
        return $this->db->get()->result_array();
    }

    public function get_all_join_table_group($table1, $table2, $key, $where, $group, $join="right"){
        $this->db->from($table1);
        $this->db->join($table2, "$table1.$key = $table2.$key", $join);
        if($where)
            $this->db->where($where);
        if($group)
            $this->db->group_by($group);
        return $this->db->get()->result_array();
    }

    public function select_get_all_join_table_group($select, $table1, $table2, $key, $where, $group, $join="right"){
        if($select)
            $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2, "$table1.$key = $table2.$key", $join);
        if($where)
            $this->db->where($where);
        if($group)
            $this->db->group_by($group);
        return $this->db->get()->result_array();
    }

    public function get_all_like($table, $col, $like, $where, $orderby = "", $urut = "ASC"){
        $this->db->from($table);
        $this->db->like($col, $like);
        if($where) $this->db->where($where);
        if($orderby) $this->db->order_by($orderby, $urut);
        return $this->db->get()->result_array();
    }

    public function select($select){
        $this->db->select($select);
        return $this;
    }

    public function from($table){
        $this->db->from($table);
        return $this;
    }

    public function where($where){
        $this->db->where($where);
        return $this;
    }

    public function getOne(){
        return $this->db->get()->row_array();
    }

    public function getAll(){
        return $this->db->get()->result_array();
    }

    public function config(){
        $data = $this->get_all("config");
        return $data;
    }

    // custom 
        public function get_langganan(){
            $sewa = $this->get_all("sewa", ["hapus" => 0, "status" => "Aktif"], "jualan", "ASC");
            
            $data = [];
            foreach ($sewa as $i => $sewa) {
                $pelanggan = $this->get_one("pelanggan", ["id_pelanggan" => $sewa['id_pelanggan']]);
                $data[$i] = $sewa;
                $data[$i]['nama_pelanggan'] = $pelanggan['nama_pelanggan'];
            }
            return $data;
        }
    // custom 
}

/* End of file MY_Model.php */
