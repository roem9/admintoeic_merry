<?php
class Main_model extends CI_MODEL{
    public function add_data($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
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

    public function get_all_group_by($table, $where = "", $group = ""){
        $this->db->from($table);
        if($where)
            $this->db->where($where);
        if($group)
            $this->db->group_by($group);
        return $this->db->get()->result_array();
    }

    public function edit_data($table, $where, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function delete_data($table, $where){
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function nominal($nominal){
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);
        return $nominal;
    }

    public function get_last_id($table, $col){
        $this->db->select($col);
        $this->db->from($table);
        $this->db->order_by($col, "DESC");
        return $this->db->get()->row_array();
    }
    
    public function get_last_id_transfer(){
        $bulan = date("m", strtotime($this->input->post("tgl")));
        $tahun = date("Y", strtotime($this->input->post("tgl")));
        $this->db->select("substr(id_transfer, 1, 3) as id");
        $this->db->from("transfer");
        $this->db->where("MONTH(tgl_transfer)", $bulan);
        $this->db->where("YEAR(tgl_transfer)", $tahun);
        $this->db->order_by("id", "DESC");
        return $this->db->get()->row_array();
    }

    public function get_all_join_table($table1, $table2, $key, $where, $join="right"){
        $this->db->from($table1);
        $this->db->join($table2, "$table1.$key = $table2.$key", $join);
        if($where)
            $this->db->where($where);
        return $this->db->get()->result_array();
    }


    // other function 
    public function rupiah($angka){           
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
}