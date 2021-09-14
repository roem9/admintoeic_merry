<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Soal_model extends MY_Model {
    public function loadSoal(){
        $this->datatables->select("id_soal, nama_soal, catatan, tgl_pembuatan, tipe_soal, poin");
        $this->datatables->from("soal as a");
        $this->datatables->where("a.hapus", 0);
        $this->datatables->add_column('action','
                <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("menu-2", "me-1").'
                        Menu
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item editSoal" href="#editSoal" data-bs-toggle="modal" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail Soal
                        </a>
                        <a class="dropdown-item komponenSoal" href="#komponenSoal" data-bs-toggle="modal" data-id="$1">
                            '.tablerIcon("receipt", "me-1").'
                            Komponen Soal
                        </a>
                        <a class="dropdown-item" href="'.base_url().'soal/view/$2" target="_blank">
                            '.tablerIcon("eye", "me-1").'
                            Lihat Soal
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item hapusSoal" href="javascript:void(0)" data-id="$1">
                            '.tablerIcon("trash", "me-1").'
                            Hapus
                        </a>
                    </div>
                </span>', 'id_soal, md5(id_soal)');
        $this->datatables->add_column("soal", '$1', 'jum_soal(id_soal)');
        $this->datatables->edit_column("tgl_pembuatan", '$1', 'tgl_indo(tgl_pembuatan, lengkap)');
        return $this->datatables->generate();
    }

    public function add_soal(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $data = $this->add_data("soal", $data);
        if($data) return 1;
        else return 0;
    }

    public function add_sesi_soal(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->Main_model->add_data("sesi_soal", $data);
        if($query) return 1;
        else return 0;
    }

    public function edit_soal(){
        $id_soal = $this->input->post("id_soal");

        unset($_POST['id_soal']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $data = $this->edit_data("soal", ["id_soal" => $id_soal], $data);
        if($data) return 1;
        else return 0;
    }

    public function get_soal(){
        $id_soal = $this->input->post("id_soal");

        return $data = $this->Main_model->get_one("soal", ["id_soal" => $id_soal]);
    }

    public function get_sesi_soal($id){
        $sub = $this->get_all("sesi_soal", ["id_soal" => $id]);
        
        $data = [];
        foreach ($sub as $i => $sub) {
            $data_sub = $this->get_one("sub_soal", ["id_sub" => $sub['id_sub']]);
            $data[$i] = $data_sub;
            $data[$i]['id'] = $sub['id'];
        }

        return $data;
    }

    public function hapus_soal(){
        $id_soal = $this->input->post("id_soal");

        $data = $this->Main_model->edit_data("soal", ["id_soal" => $id_soal], ["hapus" => 1]);
        if($data)
            return 1; 
        else
            return 0;
    }

    public function hapus_sesi(){
        $query = $this->Main_model->delete_data("sesi_soal", $_POST);
        if($query) return 1;
        else return 0;
    }
}
/* End of file Soal_model.php */
