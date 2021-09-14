<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public function __construct() {
        parent::__construct(); 
        
        $this->load->model("Main_model");
        
    }

    public function laporanPenjualan(){

        $penjual = $this->_data_penjual();

        $tgl_awal = $this->input->post("tgl_awal");
        $tgl_akhir = $this->input->post("tgl_akhir");

        $data['pengiriman'] = [];

        $id_penjual = $penjual['id_penjual'];

        $data['omset'] = 0;

        $pengiriman = $this->Main_model->get_all("pengiriman", "tgl_pengiriman BETWEEN '$tgl_awal' AND '$tgl_akhir' AND hapus = 0 AND id_penjual = '$id_penjual' AND status = 'Selesai'", "tgl_pengiriman", "ASC");
        foreach ($pengiriman as $i => $pengiriman) {
            $data['pengiriman'][$i] = $pengiriman;
            $detail = $this->Main_model->get_all("detail_pengiriman", ["id_pengiriman" => $pengiriman['id_pengiriman'], "hapus" => 0]);
            $data['pengiriman'][$i]['row'] = COUNT($detail);

            $jual = 0;
            $return = 0;

            foreach ($detail as $j => $detail) {
                $data['pengiriman'][$i]['detail'][$j] = $detail;
                $barang = $this->Main_model->get_one("barang", ["id_barang" => $detail['id_barang']]);
                $data['pengiriman'][$i]['detail'][$j]['barang'] = $barang;

                $jual += ($detail['harga'] - $detail['bagi_hasil']) * $detail['kirim'];
                $return += $detail['harga'] * $detail['kembali'];
            }

            $data['pengiriman'][$i]['jumlah'] = $jual - $return;
            
            $data['omset'] += $data['pengiriman'][$i]['jumlah'];
        }


        return $data;

    }

    function _data_penjual(){
        $username = $this->session->userdata('username');
        $data = $this->Main_model->get_one("penjual", ["username" => $username]);

        return $data;
    }

}

/* End of file Laporan_model.php */
