<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        //Do your magic here
        // if(!$this->session->userdata('toeflitp.id')){
        //     $this->session->set_flashdata('pesan', '
        //         <div class="alert alert-important alert-danger alert-dismissible" role="alert">
        //             <div class="d-flex">
        //                 <div>
        //                     <svg width="24" height="24" class="alert-icon">
        //                         <use xlink:href="'.base_url().'assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-alert-circle" />
        //                     </svg>
        //                 </div>
        //                 <div>
        //                     Anda harus login terlebih dahulu
        //                 </div>
        //             </div>
        //             <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
        //         </div>
        //     ');

		// 	redirect(base_url("auth"));
		// }
    }

    public function index(){
        // navbar and sidebar
        $data['menu'] = "Dashboard";

        // for title and header 
        $data['title'] = "Dashboard";

        $data['modal'] = ["modal_setting"];
        // javascript 
        $data['js'] = [
            "modules/other.js",
            "modules/setting.js",
            "load_data/reload_home.js",
        ];
        
        $data['soal'] = COUNT($this->Main_model->get_all("soal", ["hapus" => 0]));
        $data['tes'] = COUNT($this->Main_model->get_all("tes", ["hapus" => 0]));
        $data['peserta'] = COUNT($this->Main_model->get_all("peserta")) + COUNT($this->home->get_all("peserta_toefl"));

        $this->load->view("pages/index", $data);
    }

    public function nilai_toefl(){
        // navbar and sidebar
        $data['menu'] = "Nilai TOEFL";

        // for title and header 
        $data['title'] = "Nilai TOEFL";

        $data['modal'] = ["modal_setting"];
        // javascript 
        $data['js'] = [
            "modules/other.js",
            "modules/setting.js",
        ];

        $data['listening'] = $this->Main_model->get_all("nilai_toefl", ["tipe" => "Listening"], "soal");
        $this->load->view("pages/nilai_toefl", $data);
    }

    public function get_dashboard(){
        $data['soal'] = COUNT($this->Main_model->get_all("soal", ["hapus" => 0]));
        $data['tes'] = COUNT($this->Main_model->get_all("tes", ["hapus" => 0]));
        $data['peserta'] = COUNT($this->Main_model->get_all("peserta"));

        echo json_encode($data);
    }

    public function getSetting(){
        $data['web_admin'] = $this->Main_model->get_one("config", ["field" => "web admin"]);
        $data['web_peserta'] = $this->Main_model->get_one("config", ["field" => "web peserta"]);

        echo json_encode($data);
    }

    public function get_poin($tipe){
        if($tipe == "listening"){
            $data = $this->Main_model->get_all("nilai_toefl", ["tipe" => "Listening"], "soal");
        } else if($tipe == "structure"){
            $data = $this->Main_model->get_all("nilai_toefl", ["tipe" => "Structure"], "soal");
        } else if($tipe == "reading"){
            $data = $this->Main_model->get_all("nilai_toefl", ["tipe" => "Reading"], "soal");
        }

        echo json_encode($data);
    }

    public function get_poin_toeic($tipe){
        if($tipe == "listening"){
            $data = $this->Main_model->get_all("nilai_toeic", ["tipe" => "Listening"], "soal");
        } else if($tipe == "reading"){
            $data = $this->Main_model->get_all("nilai_toeic", ["tipe" => "Reading"], "soal");
        }

        echo json_encode($data);
    }

    public function edit_pengaturan(){
        $data = $this->home->edit_pengaturan();
        echo json_encode($data);
    }

    public function edit_poin(){
        $data = $this->home->edit_poin();
        echo json_encode(1);
    }

    public function edit_poin_toeic(){
        $data = $this->home->edit_poin_toeic();
        echo json_encode(1);
    }

    public function upload_logo(){
        if(isset($_FILES['file']['name'])) {

            $nama_file = $_FILES['file']['name']; // Nama Audio
            $size        = $_FILES['file']['size'];// Size Audio
            $error       = $_FILES['file']['error'];
            $tipe_img  = $_FILES['file']['type']; //tipe audio untuk filter
            $folder      = "./assets/img/"; //folder tujuan upload
            $valid       = array('png', 'PNG'); //Format File yang di ijinkan Masuk ke server
            
            if(strlen($nama_file)){   
                 // Perintah untuk mengecek format gambar
                 list($txt, $ext) = explode(".", $nama_file);
                 if(in_array($ext,$valid)){   

                     // Perintah untuk mengupload file dan memberi nama baru
                    switch ($tipe_img) {
                        case 'image/jpeg':
                            $tipe_img = "jpg";
                            break;
                        case 'image/png':
                            $tipe_img = "png";
                            break;
                        case 'image/gif':
                            $tipe_img = "gif";
                            break;
                        default:
                            break;
                    }

                     $img_agency = "logo.png";

                     $tmp = $_FILES['file']['tmp_name'];
                    
                     
                    if(move_uploaded_file($tmp, $folder.$img_agency)){
                        echo json_encode(1);
                    } else { // Jika Audio Gagal Di upload 
                        echo json_encode(0);
                    }
                 } else{ 
                    echo json_encode(2);
                }
        
            }
            
        }
    }

    public function getPengaturanAkun(){
        $data = $this->home->getPengaturanAkun();
        echo json_encode($data);
    }
}

/* End of file Home.php */
