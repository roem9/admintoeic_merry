<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Soal extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model("Main_model");
        $this->load->model("Other_model");
        $this->load->model("Soal_model");
    }
    
    public function index(){
        // navbar and sidebar
        $data['menu'] = "Soal";

        // for title and header 
        $data['title'] = "List Soal";

        // for modal 
        $data['modal'] = [
            "modal_soal",
            "modal_setting"
        ];
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/setting.js",
            "modules/soal.js",
            // "load_data/reload_soal.js",
            "load_data/soal_reload.js",
        ];

        $data['sub_soal'] = $this->Main_model->get_all("sub_soal", ["hapus" => 0], "nama_sub");

        // $this->load->view("pages/soal/list-soal", $data);
        $this->load->view("pages/soal/list", $data);
    }

    public function view($id_soal){
        $soal = $this->soal->get_one("soal", ["md5(id_soal)" => $id_soal]);

        $data['menu'] = "View";
        
        // for title and header 
        $data['title'] = "Soal " . $soal['nama_soal'];

        // for modal 
        $data['modal'] = [
            "modal_setting"
        ];
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/setting.js",
        ];

        $data['link'] = $this->Main_model->get_one("config", ['field' => "web admin"]);
        $soal = $this->Main_model->get_one("soal", ["md5(id_soal)" => $id_soal]);
        $sesi = $this->Main_model->get_all("sesi_soal", ["id_soal" => $soal['id_soal']]);

        $data['soal'] = $soal;
        foreach ($sesi as $i => $sesi) {
            $sub_soal = $this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub']], 'urutan');
            $data['sesi'][$i] = [];
            $number = 1;
            foreach ($sub_soal as $j => $soal) {
                if($soal['item'] == "soal"){
                    // from json to array 
                    // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
                    $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                    // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
                    $txt_soal = json_decode($string, true );
                    
                    if($soal['penulisan'] == "RTL"){
                        $no = $this->Other_model->angka_arab($number).". ";
                        $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
                    } else {
                        $no = $number.". ";
                        $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
                    }

                    $data['sesi'][$i]['soal'][$j]['id_item'] = $soal['id_item'];
                    $data['sesi'][$i]['soal'][$j]['item'] = $soal['item'];
                    $data['sesi'][$i]['soal'][$j]['data']['soal'] = $txt_soal['soal'];
                    $data['sesi'][$i]['soal'][$j]['data']['pilihan'] = $txt_soal['pilihan'];
                    $data['sesi'][$i]['soal'][$j]['data']['jawaban'] = $txt_soal['jawaban'];
                    $data['sesi'][$i]['soal'][$j]['penulisan'] = $soal['penulisan'];
                    
                    $number++;

                } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio" || $soal['item'] == "gambar"){
                    $data['sesi'][$i]['soal'][$j] = $soal;
                }

                $data['sesi'][$i]['jumlah_soal'] = COUNT($this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub'], "item" => "soal"]));
                $data['sesi'][$i]['id_sub'] = $sesi['id_sub'];
                $data['sesi'][$i]['data'] = $this->soal->get_one("sub_soal", ["id_sub" => $sesi['id_sub']]);
            }
        }

        $this->load->view("pages/soal/view-soal", $data);
    }
    
    public function loadSoal(){
        header('Content-Type: application/json');
        $output = $this->soal->loadSoal();
        echo $output;
    }

    public function add_soal(){
        $data = $this->soal->add_soal();
        echo json_encode($data);
    }

    public function add_sesi_soal(){
        $data = $this->soal->add_sesi_soal();
        echo json_encode($data);
    }

    public function get_soal(){
        $data = $this->soal->get_soal();
        echo json_encode($data);
    }

    public function get_sesi_soal($id){
        $data = $this->soal->get_sesi_soal($id);
        echo json_encode($data);
    }

    public function edit_soal(){
        $data = $this->soal->edit_soal();
        echo json_encode($data);
    }

    public function hapus_soal(){
        $data = $this->soal->hapus_soal();
        echo json_encode($data);
    }

    public function hapus_sesi(){
        $data = $this->soal->hapus_sesi();
        echo json_encode($data);
    }
}

/* End of file Soal.php */