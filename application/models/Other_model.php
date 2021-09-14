<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Other_model extends CI_Model {

    function hari_ini($hari){
        // $hari = date ("D");
    
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
    
            case 'Mon':			
                $hari_ini = "Senin";
            break;
    
            case 'Tue':
                $hari_ini = "Selasa";
            break;
    
            case 'Wed':
                $hari_ini = "Rabu";
            break;
    
            case 'Thu':
                $hari_ini = "Kamis";
            break;
    
            case 'Fri':
                $hari_ini = "Jumat";
            break;
    
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak di ketahui";		
            break;
        }
    
        return $hari_ini;
    
    }

    public function tgl_indo($tgl){
        $data = explode("-", $tgl);
        $hari = $data[0];
        $bulan = $data[1];
        $tahun = $data[2];

        if($bulan == "01") $bulan = "Januari";
        if($bulan == "02") $bulan = "Februari";
        if($bulan == "03") $bulan = "Maret";
        if($bulan == "04") $bulan = "April";
        if($bulan == "05") $bulan = "Mei";
        if($bulan == "06") $bulan = "Juni";
        if($bulan == "07") $bulan = "Juli";
        if($bulan == "08") $bulan = "Agustus";
        if($bulan == "09") $bulan = "September";
        if($bulan == "10") $bulan = "Oktober";
        if($bulan == "11") $bulan = "November";
        if($bulan == "12") $bulan = "Desember";

        return $hari . " " . $bulan . " " . $tahun;
    }

    public function angka_arab($data){
        $data = str_replace("0", "٠", $data);
        $data = str_replace("1", "١", $data);
        $data = str_replace("2", "٢", $data);
        $data = str_replace("3", "٣", $data);
        $data = str_replace("4", "٤", $data);
        $data = str_replace("5", "٥", $data);
        $data = str_replace("6", "٦", $data);
        $data = str_replace("7", "٧", $data);
        $data = str_replace("8", "٨", $data);
        $data = str_replace("9", "٩", $data);

        return $data;
    }
}

/* End of file Other_model.php */
