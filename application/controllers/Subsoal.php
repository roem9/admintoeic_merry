<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subsoal extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("Main_model");
        $this->load->model("Other_model");
    }
    
    public function index(){
        // navbar and sidebar
        $data['menu'] = "Subsoal";

        // for title and header 
        $data['title'] = "List Sub Soal";

        // for modal 
        $data['modal'] = [
            "modal_subsoal",
            "modal_setting"
        ];
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/setting.js",
            "modules/subsoal.js",
            "load_data/subsoal_reload.js",
        ];

        // $this->load->view("pages/subsoal/list-soal", $data);
        $this->load->view("pages/subsoal/list", $data);
    }

    public function edit($id){
        $soal = $this->Main_model->get_one("sub_soal", ["md5(id_sub)" => $id, "hapus" => 0]);
        
        // id soal 
        $data['id'] = $id;
        $data['title'] = "List Soal " . $soal['nama_sub'];
        
        $data['menu'] = "Item";

        // for modal 
        $data['modal'] = [
            "modal_item_soal",
            "modal_setting"
        ];
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/setting.js",
            "modules/item_soal.js",
            // "load_data/reload_soal_listening.js",
            "load_data/item_soal_reload.js",
        ];

        // $this->load->view("pages/subsoal/list-soal", $data);
        $this->load->view("pages/subsoal/list-item", $data);
    }

    public function hasil($id){
        // navbar and sidebar
        $data['menu'] = "Soal";

        // for title and header 
        $data['title'] = "List Hasil Soal";

        $respon = $this->Main_model->get_all("peserta", ["md5(id_sub)" => $id]);
        $data['respon'] = [];
        foreach ($respon as $i => $respon) {
            $data['respon'][$i] = $respon;
            $jawaban = explode("###", $respon['text']);
            $data['respon'][$i]['text'] = $jawaban;
        }

        $this->load->view("pages/subsoal/hasil-soal", $data);
    }

    public function loadSubSoal(){
        header('Content-Type: application/json');
        $output = $this->subsoal->loadSubSoal();
        echo $output;
    }

    public function add_subsoal(){
        $data = $this->subsoal->add_subsoal();
        echo json_encode($data);
    }
    
    public function get_subsoal(){
        $data = $this->subsoal->get_subsoal();
        echo json_encode($data);
    }

    public function update_subsoal(){
        $data = $this->subsoal->update_subsoal();
        echo json_encode($data);
    }

    public function delete_subsoal(){
        $data = $this->subsoal->delete_subsoal();
        echo json_encode($data);
    }

    public function add_item_soal(){
        $data = $this->subsoal->add_item_soal();
        echo json_encode($data);
    }

    public function get_all_item_soal(){
        $data = $this->subsoal->get_all_item_soal();
        echo json_encode($data);
    }

    public function get_item_soal(){
        $data = $this->subsoal->get_item_soal();
        echo json_encode($data);
    }
    
    public function edit_item_soal(){
        $data = $this->subsoal->edit_item_soal();
        echo json_encode($data);
    }

    public function edit_urutan_soal(){
        $data = $this->subsoal->edit_urutan_soal();
        echo json_encode($data);
    }

    public function hapus_item_soal(){
        $data = $this->subsoal->hapus_item_soal();
        echo json_encode($data);
    }
}

/* End of file Soal.php */