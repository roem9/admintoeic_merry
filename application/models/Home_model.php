<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends MY_Model {
    public function edit_poin(){
        $id = $this->input->post("id");
        $poin = $this->input->post("poin");

        foreach ($id as $i => $id) {
            $this->edit_data("nilai_toefl", ["id" => $id], ["poin" => $poin[$i]]);
        }
    }
    
    public function edit_poin_toeic(){
        $id = $this->input->post("id");
        $poin = $this->input->post("poin");

        foreach ($id as $i => $id) {
            $this->edit_data("nilai_toeic", ["id" => $id], ["poin" => $poin[$i]]);
        }
    }

    public function getPengaturanAkun(){
        $id_admin = $this->session->userdata("id_admin");
        $data = $this->get_one("admin", ["id_admin" => $id_admin]);
        $config = $this->get_one("config", ["field" => "background"]);
        $data['background'] = $config['value'];
        $config = $this->get_one("config", ["field" => "no_wa"]);
        $data['no_wa'] = $config['value'];
        return $data;
    }

    public function edit_pengaturan(){
        $background = $this->input->post("background");
        $no_wa = $this->input->post("no_wa");
        unset($_POST['no_wa']);
        unset($_POST['background']);
        $this->edit_data("config", ["field" => "no_wa"], ["value" => $no_wa]);
        $this->edit_data("config", ["field" => "background"], ["value" => $background]);

        $id_admin = $this->input->post("id_admin");
        unset($_POST['id_admin']);

        $data = [];
        foreach ($_POST as $key => $value) {
            if($key == "password"){
                if($this->input->post("password") != ""){
                    $data[$key] = md5($this->input->post($key));
                }
            } else {
                $data[$key] = $this->input->post($key);
            }
        }
        
        if(!empty($data)) $query = $this->edit_data("admin", ["id_admin" => $id_admin], $data);

        return 1;
    }
}

/* End of file Home_model.php */
