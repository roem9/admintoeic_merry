<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Audio_model extends MY_Model {

    public function loadAudio(){
        $id_admin = $this->session->userdata("id_admin");

        $this->datatables->select("id_audio, nama_audio, nama_file, id_admin");
        $this->datatables->where("id_admin", $id_admin);
        $this->datatables->from("audio as a");
        $this->datatables->add_column('action','
                <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("menu-2", "me-1").'
                        Menu
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item editAudio" href="#editAudio" data-bs-toggle="modal" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail Audio
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item hapusAudio" href="javascript:void(0)" data-id="$1">
                            '.tablerIcon("trash", "me-1").'
                            Hapus
                        </a>
                    </div>
                </span>', 'id_audio, md5(id_audio)');
            
        return $this->datatables->generate();
    }

    public function edit_audio(){
        $id_admin = $this->session->userdata('id_admin');
        $id_audio = $this->input->post("id_audio");
        
        $data = [
            "nama_audio" => $this->input->post("nama_audio"),
        ];

        $data = $this->edit_data("audio", ["id_audio" => $id_audio, "id_admin" => $id_admin], $data);
        if($data){
            return 1;
        } else {
            return 0;
        }
    }

    public function add_audio(){
        if(isset($_FILES['file']['name'])) {
            $id_admin = $this->session->userdata("id_admin");
            $id = $this->Main_model->get_one("audio", "", "id_audio", "DESC");

            $nama_file = $_FILES['file'] ['name']; // Nama Audio
            $size        = $_FILES['file'] ['size'];// Size Audio
            $error       = $_FILES['file'] ['error'];
            $tipe_audio  = $_FILES['file'] ['type']; //tipe audio untuk filter
            $folder      = "./assets/myaudio/"; //folder tujuan upload
            $valid       = array('mp3'); //Format File yang di ijinkan Masuk ke server
            
            if(strlen($nama_file)){

                 list($txt, $ext) = explode(".", $nama_file);
                 if(in_array($ext,$valid)){
                     $audio = $id['id_audio'] + 1 . ".mp3";

                     $tmp = $_FILES['file']['tmp_name'];
                     
                    if(move_uploaded_file($tmp, $folder.$audio)){
                        $data = [
                            "nama_audio" => $this->input->post("nama_audio"),
                            "nama_file" => $audio,
                            "id_admin" => $id_admin
                        ];
                        
                        $this->Main_model->add_data("audio", $data);
                        return 1;
                        
                    } else {
                        return 0;
                    }
                 } else{
                    return 2;
                }
        
            }
            
        }
    }

    public function get_audio(){
        $id_admin = $this->session->userdata("id_admin");
        $id_audio = $this->input->post("id_audio");
        $data = $this->Main_model->get_one("audio", ["id_audio" => $id_audio, "id_admin" => $id_admin]);
        return $data;
    }

    public function get_all_audio(){
        $id_admin = $this->session->userdata("id_admin");
        $data = $this->Main_model->get_all("audio", ["id_admin" => $id_admin], "nama_audio");
        return $data;
    }

    public function delete_audio(){
        $id_admin = $this->session->userdata("id_admin");
        $id_audio = $this->input->post("id_audio");
        $data = $this->Main_model->get_one("audio", ["id_audio" => $id_audio, "id_admin" => $id_admin]);
        
        $this->Main_model->delete_data("audio", ["id_audio" => $id_audio, "id_admin" => $id_admin]);

        if($data){
            unlink('./assets/myaudio/'.$data['nama_file']);
            return 1;
        } else {
            return 0;
        }
    }
}

/* End of file Subsoal.php */
