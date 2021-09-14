<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Audio extends MY_Controller {

    
    public function __construct(){
        parent::__construct();
        $this->load->model("Main_model");
    }
    
    public function index(){
        // for if statement navbar fitur
        $data['menu'] = "Audio";

        // for title and header 
        $data['title'] = "List Audio";

        // for modal 
        $data['modal'] = [
            "modal_audio",
            "modal_setting"
        ];
        
        // for js 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/setting.js", 
            "modules/audio.js",
            "load_data/audio_reload.js",
        ];

        $this->load->view("pages/audio/list", $data);
    }

    public function loadAudio(){
        header('Content-Type: application/json');
        $output = $this->audio->loadAudio();
        echo $output;
    }

    public function add_audio(){
        $data = $this->audio->add_audio();
        echo json_encode($data);
    }

    public function get_audio(){
        $data = $this->audio->get_audio();
        echo json_encode($data);
    }

    public function get_all_audio(){
        $data = $this->audio->get_all_audio();
        echo json_encode($data);
    }

    public function edit_audio(){
        $data = $this->audio->edit_audio();
        echo json_encode($data);
    }

    public function delete_audio(){
        $data = $this->audio->delete_audio();
        echo json_encode($data);
    }
}

/* End of file Audio.php */
