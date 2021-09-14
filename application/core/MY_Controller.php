<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $model = strtolower(get_class($this));
        // if(file_exists('application/models/' . $model . '_model.php')){
            $this->load->model($model . '_model', $model, true);
        // }
        
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
    

}

/* End of file MY_Controller.php */
