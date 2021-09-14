<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->model("Main_model");
        $this->load->model("Other_model");
        $this->load->model("Soal_model");
    
        // Load Pagination library
        $this->load->library('pagination');

        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
        
        if(!$this->session->userdata('toeflitp.id')){
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg width="24" height="24" class="alert-icon">
                                <use xlink:href="'.base_url().'assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-alert-circle" />
                            </svg>
                        </div>
                        <div>
                            Anda harus login terlebih dahulu
                        </div>
                    </div>
                    <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            ');

			redirect(base_url("auth"));
		}
    }
    
    public function index(){
        // navbar and sidebar
        $data['menu'] = "Form";

        // for title and header 
        $data['title'] = "List Form";

        // for modal 
        $data['modal'] = [
            "modal_form",
            "modal_setting"
        ];
        
        // javascript 
        $data['js'] = [
            "modules/other.js", 
            "modules/setting.js",
            "modules/form.js",
            "load_data/reload_form.js",
        ];

        $this->load->view("pages/form/list", $data);
    }

    public function edit($id){
        $soal = $this->Main_model->get_one("form", ["md5(id_form)" => $id, "hapus" => 0]);
        
        // id soal 
        $data['id'] = $id;
        $data['title'] = $soal['nama_form'];
        
        $data['menu'] = "Item";

        // for modal 
        $data['modal'] = [
            "modal_item_form",
            "modal_setting"
        ];
        
        // javascript 
        $data['js'] = [
            "modules/other.js", 
            "modules/setting.js",
            "modules/item_form.js",
            "load_data/reload_item_form.js",
        ];

        $this->load->view("pages/form/list-item", $data);
    }

    public function loadRecord($rowno=0){
        $this->load->helper('myhelper_helper');
        
        // Row per page
        $rowperpage = 6;
    
        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
    
        // All records count
        $allcount = COUNT($this->Main_model->get_all("form", ["hapus" => 0], "tgl_input", "DESC"));
    
        // Get records
        $record = $this->Main_model->get_all_limit("form", ["hapus" => 0], "tgl_input", "DESC", $rowno, $rowperpage);

        $users_record = [];

        foreach ($record as $i => $record) {
            $users_record[$i] = $record;
            $users_record[$i]['tgl_input'] = hari_ini(date("D", strtotime($record['tgl_input']))) . ", " . tgl_indo(date("d-M-Y", strtotime($record['tgl_input'])));
            $users_record[$i]['link'] = md5($record['id_form']);
        }
     
        // Pagination Configuration
        $config['base_url'] = base_url().'subsoal/loadRecord';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = "First";
        $config['last_link']        = "Last";
        $config['next_link']        = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>';
        $config['prev_link']        = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>';
        $config['full_tag_open']    = '<nav><ul class="pagination pagination-md justify-content-center">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        // Initialize
        $this->pagination->initialize($config);
    
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['row'] = $rowno;
        $data['total_rows'] = $allcount;
        $data['total_rows_perpage'] = COUNT($users_record);
    
        echo json_encode($data);
     
    }
    

    // add 
        public function add(){
            $data = $this->Main_model->add_data("form", $_POST);
            if($data){
                echo json_encode("1");
            } else {
                echo json_encode("0");
            }
        }

        public function add_item_soal(){
            $id_sub = $this->input->post("id_sub");
            $soal = $this->Main_model->get_one("sub_soal", ["md5(id_sub)" => $id_sub]);

            $item = $this->Main_model->get_one("item_soal", ["md5(id_sub)" => $id_sub], "urutan", "DESC");
            if($item) {
                $urutan = $item['urutan'] + 1;
            } else {
                $urutan = 1;
            }

            $data = [
                "id_sub" => $soal['id_sub'],
                "item" => $this->input->post("item"),
                "data" => trim($this->input->post("data_soal")),
                "penulisan" => $this->input->post("penulisan"),
                "urutan" => $urutan,
            ];

            $query = $this->Main_model->add_data("item_soal", $data);
            if($query){
                echo json_encode(1);
            } else {
                echo json_encode(0);
            }
        }
    // add 
    
    // get 
        public function get(){
            $id_form = $this->input->post("id_form");

            $data = $this->Main_model->get_one("form", ["id_form" => $id_form]);
            echo json_encode($data);
        }

        public function get_all_item(){
            $id_form = $this->input->post("id_form");

            $data = $this->Main_model->get_one("item_form", ["md5(id_form)" => $id_form]);

            $structure = $this->Main_model->get_all("item_form", ["md5(id_form)" => $id_form], "urutan", "ASC");
            $data['item'] = [];

            foreach ($structure as $i => $item) {
                $data['item'][$i] = $item;
            }

            echo json_encode($data);
        }
    // get 

    // edit 
        public function update(){
            $id_form = $this->input->post("id_form");
            
            unset($_POST['id_form']);

            $data = $this->Main_model->edit_data("form", ["id_form" => $id_form], $_POST);
            if($data){
                echo json_encode("1");
            } else {
                echo json_encode("0");
            }
        }

        public function edit_item(){
            $id_item = $this->input->post("id_item");

            $data = [
                "data" => $this->input->post("data_soal"),
                "penulisan" => $this->input->post("penulisan"),
            ];

            $query = $this->Main_model->edit_data("item_soal", ["id_item" => $id_item], $data);
            if($query){
                echo json_encode(1);
            } else {
                echo json_encode(0);
            }
        }

        public function edit_urutan(){
            $id_item = $this->input->post("id_item");

            $i = 1;
            foreach ($id_item as $item) {
                $this->Main_model->edit_data("item_soal", ["id_item" => $item], ["urutan" => $i]);
                $i++;
            }

            echo json_encode(1);
        }
    // edit 

    // delete 
        public function delete(){
            $id_sub = $this->input->post("id_sub");

            $data = $this->Main_model->edit_data("sub_soal", ["id_sub" => $id_sub], ["hapus" => 1]);
            if($data){
                echo json_encode("1");
            } else {
                echo json_encode("0");
            }
        }

        public function hapus_item(){
            $id_item = $this->input->post("id_item");

            $item = $this->Main_model->get_one("item_soal", ["id_item" => $id_item]);

            $id_sub = $item['id_sub'];
            $urutan = $item['urutan'];

            $all_item = $this->Main_model->get_all("item_soal", ["id_sub" => $id_sub, "urutan > ", $urutan]);
            foreach ($all_item as $item) {
                $urutan = $item['urutan'] - 1;
                $this->Main_model->edit_data("item_soal", ["id_item" => $item['id_item']], ["urutan" => $urutan]);
            }

            $data = $this->Main_model->delete_data("item_soal", ["id_item" => $id_item]);
            if($data){
                echo json_encode("1");
            } else {
                echo json_encode("0");
            }
        }
    // delete
}

/* End of file Form.php */