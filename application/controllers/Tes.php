<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends MY_Controller {
    public function index(){
        // navbar and sidebar
        $data['menu'] = "Tes";

        // for title and header 
        $data['title'] = "List Tes";

        // for modal 
        $data['modal'] = [
            "modal_tes",
            "modal_setting"
        ];
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/setting.js",
            "load_data/tes_reload.js",
            "modules/tes.js",
        ];

        $listSoal = $this->tes->get_all("soal", ["hapus" => 0], "nama_soal");
        foreach ($listSoal as $i => $list) {
            $data['listSoal'][$i] = $list;
            $data['listSoal'][$i]['soal'] = jum_soal($list['id_soal']);
        }

        $this->load->view("pages/tes/list", $data);
    }

    public function hasil($id){
        $tes = $this->tes->get_one("tes", ["md5(id_tes)" => $id]);
        $soal = $this->tes->get_one("soal", ["id_soal" => $tes['id_soal']]);

        $data['tipe'] = $soal['tipe_soal'];
        $data['menu'] = "Hasil";
        $data['id'] = $id;

        // for title and header 
        $data['title'] = "Hasil ".$tes['nama_tes'];

        // for modal 
        $data['modal'] = [
            "modal_hasil_tes",
            "modal_setting"
        ];
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/setting.js",
            "load_data/hasil_tes_toefl_reload.js",
            "modules/hasil_tes_toefl.js",
        ];

        if($soal['tipe_soal'] == "TOAFL" || $soal['tipe_soal'] == "TOEFL"){
            $this->load->view("pages/tes/list-hasil-toefl", $data);
        } else if($soal['tipe_soal'] == "TOEIC"){
            $this->load->view("pages/tes/list-hasil-toeic", $data);
        } else {
            $this->load->view("pages/tes/list-hasil-latihan", $data);
        }
    }

    // excel
        public function export($file, $id_tes){
            $tes = $this->tes->get_one("tes", ["md5(id_tes)" => $id_tes]);
            $tahun = date('y', strtotime($tes['tgl_tes']));
            $soal = $this->tes->get_one("soal", ["id_soal" => $tes['id_soal']]);
            
            $spreadsheet = new Spreadsheet;

            if($soal){
                if($soal['tipe_soal'] == "TOAFL" || $soal['tipe_soal'] == "TOEFL"){

                    if($file == "hasil"){
                        $semua_peserta = $this->tes->get_all("peserta_toefl", ["id_tes" => $tes['id_tes']]);
                        $file_data = "Hasil Keseluruhan";
                    } else if($file == "sertifikat"){
                        $semua_peserta = $this->tes->get_all("peserta_toefl", ["id_tes" => $tes['id_tes'], "no_doc <> " => ""], "(no_doc + 0)");
                        $file_data = "Sertifikat";
                    }
        
                    $spreadsheet->setActiveSheetIndex(0)
                                ->setCellValue('A1', 'LIST PESERTA ' . $tes['nama_tes'])
                                ->setCellValue('A2', 'No')
                                ->setCellValue('B2', 'No. Sertifikat')
                                ->setCellValue('C2', 'Nama')
                                ->setCellValue('D2', 'TTL')
                                ->setCellValue('E2', 'Alamat')
                                ->setCellValue('F2', 'No. WA')
                                ->setCellValue('G2', 'email')
                                ->setCellValue('H2', 'Nilai Listening')
                                ->setCellValue('H3', 'Benar')
                                ->setCellValue('I3', 'Skor')
                                ->setCellValue('J2', 'Nilai Structure')
                                ->setCellValue('J3', 'Benar')
                                ->setCellValue('K3', 'Skor')
                                ->setCellValue('L2', 'Nilai Reading')
                                ->setCellValue('L3', 'Benar')
                                ->setCellValue('M3', 'Skor')
                                ->setCellValue('N2', 'SKOR TOEFL');
    
                    $spreadsheet->getActiveSheet()->mergeCells('A2:A3')
                                ->mergeCells('B2:B3')
                                ->mergeCells('C2:C3')
                                ->mergeCells('D2:D3')
                                ->mergeCells('E2:E3')
                                ->mergeCells('F2:F3')
                                ->mergeCells('G2:G3')
                                ->mergeCells('H2:I2')
                                ->mergeCells('J2:K2')
                                ->mergeCells('L2:M2')
                                ->mergeCells('N2:N3')
                                ->mergeCells('A1:N1');
                    
                    $kolom = 4;
                    $nomor = 1;
                    foreach($semua_peserta as $peserta) {

                        if($peserta['no_doc'] != "") $no_doc = "{$tahun}/{$peserta['no_doc']}";
                        else $no_doc = "-";

                            $spreadsheet->setActiveSheetIndex(0)
                                        ->setCellValue('A' . $kolom, $nomor)
                                        ->setCellValue('B' . $kolom, $no_doc)
                                        ->setCellValue('C' . $kolom, $peserta['nama'])
                                        ->setCellValue('D' . $kolom, $peserta['t4_lahir'] . ", " . tgl_indo($peserta['tgl_lahir']))
                                        ->setCellValue('E' . $kolom, $peserta['alamat'])
                                        ->setCellValue('F' . $kolom, $peserta['no_wa'])
                                        ->setCellValue('G' . $kolom, $peserta['email'])
                                        ->setCellValue('H' . $kolom, $peserta['nilai_listening'])
                                        ->setCellValue('I' . $kolom, poin("Listening", $peserta['nilai_listening']))
                                        ->setCellValue('J' . $kolom, $peserta['nilai_structure'])
                                        ->setCellValue('K' . $kolom, poin("Structure", $peserta['nilai_structure']))
                                        ->setCellValue('L' . $kolom, $peserta['nilai_reading'])
                                        ->setCellValue('M' . $kolom, poin("Reading", $peserta['nilai_reading']))
                                        ->setCellValue('N' . $kolom, skor($peserta['nilai_listening'], $peserta['nilai_structure'], $peserta['nilai_reading']));
            
                            $kolom++;
                            $nomor++;
            
                    }

                    foreach(range('A','N') as $columnID) {
                        $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                            ->setAutoSize(true);
                    }

                    $writer = new Xlsx($spreadsheet);
        
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'.$tes['nama_tes'].' '.$file_data.'.xlsx"');
                    header('Cache-Control: max-age=0');
        
                    $writer->save('php://output');
                } else if($soal['tipe_soal'] == "TOEIC"){
                    if($file == "hasil"){
                        $semua_peserta = $this->tes->get_all("peserta_toeic", ["id_tes" => $tes['id_tes']]);
                        $file_data = "Hasil Keseluruhan";
                    } else if($file == "sertifikat"){
                        $semua_peserta = $this->tes->get_all("peserta_toeic", ["id_tes" => $tes['id_tes'], "no_doc <> " => ""], "(no_doc + 0)");
                        $file_data = "Sertifikat";
                    }
        
                    $spreadsheet->setActiveSheetIndex(0)
                                ->setCellValue('A1', 'LIST PESERTA ' . $tes['nama_tes'])
                                ->setCellValue('A2', 'No')
                                ->setCellValue('B2', 'No. Sertifikat')
                                ->setCellValue('C2', 'Nama')
                                ->setCellValue('D2', 'TTL')
                                ->setCellValue('E2', 'Alamat')
                                ->setCellValue('F2', 'No. WA')
                                ->setCellValue('G2', 'email')
                                ->setCellValue('H2', 'Nilai Listening')
                                ->setCellValue('H3', 'Benar')
                                ->setCellValue('I3', 'Skor')
                                ->setCellValue('J2', 'Nilai Reading')
                                ->setCellValue('J3', 'Benar')
                                ->setCellValue('K3', 'Skor')
                                ->setCellValue('L2', 'SKOR TOEIC');
    
                    $spreadsheet->getActiveSheet()->mergeCells('A2:A3')
                                ->mergeCells('B2:B3')
                                ->mergeCells('C2:C3')
                                ->mergeCells('D2:D3')
                                ->mergeCells('E2:E3')
                                ->mergeCells('F2:F3')
                                ->mergeCells('G2:G3')
                                ->mergeCells('H2:I2')
                                ->mergeCells('J2:K2')
                                ->mergeCells('L2:L3')
                                ->mergeCells('A1:L1');
                    
                    $kolom = 4;
                    $nomor = 1;
                    foreach($semua_peserta as $peserta) {

                        if($peserta['no_doc'] != "") $no_doc = "{$tahun}/{$peserta['no_doc']}";
                        else $no_doc = "-";

                            $spreadsheet->setActiveSheetIndex(0)
                                        ->setCellValue('A' . $kolom, $nomor)
                                        ->setCellValue('B' . $kolom, $no_doc)
                                        ->setCellValue('C' . $kolom, $peserta['nama'])
                                        ->setCellValue('D' . $kolom, $peserta['t4_lahir'] . ", " . tgl_indo($peserta['tgl_lahir']))
                                        ->setCellValue('E' . $kolom, $peserta['alamat'])
                                        ->setCellValue('F' . $kolom, $peserta['no_wa'])
                                        ->setCellValue('G' . $kolom, $peserta['email'])
                                        ->setCellValue('H' . $kolom, $peserta['nilai_listening'])
                                        ->setCellValue('I' . $kolom, poin_toeic("Listening", $peserta['nilai_listening']))
                                        ->setCellValue('J' . $kolom, $peserta['nilai_reading'])
                                        ->setCellValue('K' . $kolom, poin_toeic("Reading", $peserta['nilai_reading']))
                                        ->setCellValue('L' . $kolom, skor_toeic($peserta['nilai_listening'], $peserta['nilai_reading']));
            
                            $kolom++;
                            $nomor++;
            
                    }

                    foreach(range('A','L') as $columnID) {
                        $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                            ->setAutoSize(true);
                    }

                    $writer = new Xlsx($spreadsheet);
        
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'.$tes['nama_tes'].' '.$file_data.'.xlsx"');
                    header('Cache-Control: max-age=0');
        
                    $writer->save('php://output');
                } else {
                    $semua_peserta = $this->tes->get_all("peserta", ["id_tes" => $tes['id_tes']]);
                    $spreadsheet->setActiveSheetIndex(0)
                                ->setCellValue('A1', '<h1>LIST PESERTA ' . $tes['nama_tes'] . '</h1>')
                                ->setCellValue('A2', 'No')
                                ->setCellValue('B2', 'Nama Lengkap')
                                ->setCellValue('C2', 'Email')
                                ->setCellValue('D2', 'Benar')
                                ->setCellValue('E2', 'Nilai');

                    $spreadsheet->getActiveSheet()->mergeCells('A1:N1');
                    
                    $kolom = 3;
                    $nomor = 1;
                    foreach($semua_peserta as $peserta) {
            
                            $spreadsheet->setActiveSheetIndex(0)
                                        ->setCellValue('A' . $kolom, $nomor)
                                        ->setCellValue('B' . $kolom, $peserta['nama'])
                                        ->setCellValue('C' . $kolom, $peserta['email'])
                                        ->setCellValue('D' . $kolom, $peserta['nilai'])
                                        ->setCellValue('E' . $kolom, skor_latihan($tes['id_tes'], $peserta['nilai']));
            
                            $kolom++;
                            $nomor++;
            
                    }
                    $writer = new Xlsx($spreadsheet);
        
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'.$tes['nama_tes'].'.xlsx"');
                    header('Cache-Control: max-age=0');
        
                    $writer->save('php://output');
                }
            }
        }
    // excel

    public function sertifikat($id){
        $peserta = $this->tes->get_one("peserta_toefl", ["md5(id)" => $id]);
        $tes = $this->tes->get_one("tes", ["id_tes" => $peserta['id_tes']]);
        $peserta['nama'] = $peserta['nama'];
        $peserta['t4_lahir'] = ucwords(strtolower($peserta['t4_lahir']));
        $peserta['tahun'] = date('y', strtotime($tes['tgl_tes']));
        $peserta['bulan'] = getRomawi(date('m', strtotime($tes['tgl_tes'])));
        $peserta['listening'] = poin("Listening", $peserta['nilai_listening']);
        $peserta['structure'] = poin("Structure", $peserta['nilai_structure']);
        $peserta['reading'] = poin("Reading", $peserta['nilai_reading']);
        $peserta['tgl_tes'] = $tes['tgl_tes'];

        $skor = ((poin("Listening", $peserta['nilai_listening']) + poin("Structure", $peserta['nilai_structure']) + poin("Reading", $peserta['nilai_reading'])) * 10) / 3;
        $peserta['skor'] = $skor;

        $skor = round($skor);
        
        $peserta['no_doc'] = "{$peserta['tahun']}/{$peserta['no_doc']}";

        $peserta['config'] = $this->tes->config();
        $peserta['id_tes'] = $peserta['id_tes'];
        
        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [148, 210], 'orientation' => 'L',
        // , 'margin_top' => '43', 'margin_left' => '25', 'margin_right' => '25', 'margin_bottom' => '35',
            'fontdata' => $fontData + [
                'rockb' => [
                    'R' => 'ROCKB.TTF',
                ],'rock' => [
                    'R' => 'ROCK.TTF',
                ],
                'arial' => [
                    'R' => 'arial.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],
                'bodoni' => [
                    'R' => 'BOD_R.TTF',
                ],
                'calibri' => [
                    'R' => 'CALIBRI.TTF',
                ],
                'cambria' => [
                    'R' => 'CAMBRIAB.TTF',
                ]
            ], 
        ]);

        $mpdf->SetTitle("{$peserta['nama']}");
        $mpdf->WriteHTML($this->load->view('pages/tes/sertifikat', $peserta, TRUE));
        $mpdf->Output("{$peserta['nama']}.pdf", "I");

    }

    public function sertifikattoeic($id){
        $peserta = $this->tes->get_one("peserta_toeic", ["md5(id)" => $id]);
        $tes = $this->tes->get_one("tes", ["id_tes" => $peserta['id_tes']]);
        $peserta['nama'] = $peserta['nama'];
        $peserta['t4_lahir'] = ucwords(strtolower($peserta['t4_lahir']));
        $peserta['tahun'] = date('y', strtotime($peserta['tgl_tes_peserta']));
        $peserta['bulan'] = getRomawi(date('m', strtotime($peserta['tgl_tes_peserta'])));
        $peserta['listening'] = poin_toeic("Listening", $peserta['nilai_listening']);
        $peserta['reading'] = poin_toeic("Reading", $peserta['nilai_reading']);
        $peserta['tgl_tes'] = $peserta['tgl_tes_peserta'];

        $skor = poin_toeic("Listening", $peserta['nilai_listening']) + poin_toeic("Reading", $peserta['nilai_reading']);
        $peserta['skor'] = $skor;

        $skor = round($skor);

        $peserta['no_doc'] = "$peserta[no_doc]/ME/".getRomawi(date('m', strtotime($peserta['tgl_tes'])))."/$peserta[tahun]";

        $peserta['config'] = $this->tes->config();
        $peserta['id_tes'] = $peserta['id_tes'];
        
        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [148, 210], 'orientation' => 'L',
        // , 'margin_top' => '43', 'margin_left' => '25', 'margin_right' => '25', 'margin_bottom' => '35',
            'fontdata' => $fontData + [
                'rockb' => [
                    'R' => 'ROCKB.TTF',
                ],'rock' => [
                    'R' => 'ROCK.TTF',
                ],
                'arial' => [
                    'R' => 'arial.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],
                'bodoni' => [
                    'R' => 'BOD_R.TTF',
                ],
                'calibri' => [
                    'R' => 'CALIBRI.TTF',
                ],
                'cambria' => [
                    'R' => 'CAMBRIAB.TTF',
                ]
            ], 
        ]);

        $mpdf->SetTitle("{$peserta['nama']}");
        $mpdf->WriteHTML($this->load->view('pages/tes/sertifikat-toeic', $peserta, TRUE));
        $mpdf->Output("{$peserta['nama']}.pdf", "I");

    }
    
    public function loadTes(){
        header('Content-Type: application/json');
        $output = $this->tes->loadTes();
        echo $output;
    }

    public function add_tes(){
        $data = $this->tes->add_tes();
        echo json_encode($data);
    }
    
    public function get_tes(){
        $id_tes = $this->input->post("id_tes");

        $data = $this->tes->get_one("tes", ["id_tes" => $id_tes]);
        echo json_encode($data);
    }

    public function loadHasil($tipe, $id){
        header('Content-Type: application/json');
        $output = $this->tes->loadHasil($tipe, $id);
        echo $output;
    }
    // load 
    
    public function get_peserta_toefl(){
        $data = $this->tes->get_peserta_toefl();
        echo json_encode($data);
    }

    public function edit_tes(){
        $data = $this->tes->edit_tes();
        echo json_encode($data);
    }

    public function change_status(){
        $data = $this->tes->change_status();
        echo json_encode($data);
    }

    public function edit_peserta_toefl(){
        $data = $this->tes->edit_peserta_toefl();
        echo json_encode($data);
    }

    public function hapus_tes(){
        $data = $this->tes->hapus_tes();
        echo json_encode($data);
    }

    public function nilai(){
        $this->tes->add_data("nilai_toeic", ["soal" => 0, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 1, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 2, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 3, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 4, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 5, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 6, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 7, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 8, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 9, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 10, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 11, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 12, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 13, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 14, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 15, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 16, "poin" => 5, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 17, "poin" => 10, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 18, "poin" => 15, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 19, "poin" => 20, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 20, "poin" => 25, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 21, "poin" => 30, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 22, "poin" => 35, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 23, "poin" => 40, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 24, "poin" => 45, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 25, "poin" => 50, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 26, "poin" => 55, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 27, "poin" => 60, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 28, "poin" => 70, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 29, "poin" => 80, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 30, "poin" => 85, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 31, "poin" => 90, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 32, "poin" => 95, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 33, "poin" => 100, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 34, "poin" => 105, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 35, "poin" => 115, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 36, "poin" => 125, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 37, "poin" => 135, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 38, "poin" => 140, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 39, "poin" => 150, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 40, "poin" => 160, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 41, "poin" => 170, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 42, "poin" => 175, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 43, "poin" => 180, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 44, "poin" => 190, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 45, "poin" => 200, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 46, "poin" => 205, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 47, "poin" => 215, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 48, "poin" => 220, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 49, "poin" => 225, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 50, "poin" => 230, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 51, "poin" => 235, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 52, "poin" => 245, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 53, "poin" => 255, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 54, "poin" => 260, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 55, "poin" => 265, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 56, "poin" => 275, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 57, "poin" => 285, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 58, "poin" => 290, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 59, "poin" => 295, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 60, "poin" => 300, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 61, "poin" => 310, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 62, "poin" => 320, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 63, "poin" => 325, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 64, "poin" => 330, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 65, "poin" => 335, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 66, "poin" => 340, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 67, "poin" => 345, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 68, "poin" => 350, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 69, "poin" => 355, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 70, "poin" => 360, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 71, "poin" => 365, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 72, "poin" => 370, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 73, "poin" => 375, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 74, "poin" => 385, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 75, "poin" => 395, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 76, "poin" => 400, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 77, "poin" => 405, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 78, "poin" => 415, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 79, "poin" => 420, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 80, "poin" => 425, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 81, "poin" => 430, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 82, "poin" => 435, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 83, "poin" => 440, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 84, "poin" => 445, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 85, "poin" => 450, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 86, "poin" => 455, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 87, "poin" => 460, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 88, "poin" => 465, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 89, "poin" => 475, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 90, "poin" => 480, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 91, "poin" => 485, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 92, "poin" => 490, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 93, "poin" => 495, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 94, "poin" => 495, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 95, "poin" => 495, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 96, "poin" => 495, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 97, "poin" => 495, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 98, "poin" => 495, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 99, "poin" => 495, "tipe" => "Listening"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 100, "poin" => 495, "tipe" => "Listening"]);

        $this->tes->add_data("nilai_toeic", ["soal" => 0, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 1, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 2, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 3, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 4, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 5, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 6, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 7, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 8, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 9, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 10, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 11, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 12, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 13, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 14, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 15, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 16, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 17, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 18, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 19, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 20, "poin" => 5, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 21, "poin" => 10, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 22, "poin" => 15, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 23, "poin" => 20, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 24, "poin" => 25, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 25, "poin" => 30, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 26, "poin" => 35, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 27, "poin" => 40, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 28, "poin" => 45, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 29, "poin" => 55, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 30, "poin" => 60, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 31, "poin" => 65, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 32, "poin" => 70, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 33, "poin" => 75, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 34, "poin" => 80, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 35, "poin" => 85, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 36, "poin" => 90, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 37, "poin" => 95, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 38, "poin" => 105, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 39, "poin" => 115, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 40, "poin" => 120, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 41, "poin" => 125, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 42, "poin" => 130, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 43, "poin" => 135, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 44, "poin" => 140, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 45, "poin" => 145, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 46, "poin" => 155, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 47, "poin" => 160, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 48, "poin" => 170, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 49, "poin" => 175, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 50, "poin" => 185, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 51, "poin" => 195, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 52, "poin" => 205, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 53, "poin" => 210, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 54, "poin" => 215, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 55, "poin" => 220, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 56, "poin" => 230, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 57, "poin" => 240, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 58, "poin" => 245, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 59, "poin" => 250, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 60, "poin" => 255, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 61, "poin" => 260, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 62, "poin" => 270, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 63, "poin" => 275, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 64, "poin" => 280, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 65, "poin" => 285, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 66, "poin" => 290, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 67, "poin" => 295, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 68, "poin" => 295, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 69, "poin" => 300, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 70, "poin" => 310, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 71, "poin" => 315, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 72, "poin" => 320, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 73, "poin" => 325, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 74, "poin" => 330, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 75, "poin" => 335, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 76, "poin" => 340, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 77, "poin" => 345, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 78, "poin" => 355, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 79, "poin" => 360, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 80, "poin" => 370, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 81, "poin" => 375, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 82, "poin" => 385, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 83, "poin" => 390, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 84, "poin" => 395, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 85, "poin" => 400, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 86, "poin" => 405, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 87, "poin" => 415, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 88, "poin" => 420, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 89, "poin" => 425, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 90, "poin" => 435, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 91, "poin" => 440, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 92, "poin" => 450, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 93, "poin" => 455, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 94, "poin" => 460, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 95, "poin" => 470, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 96, "poin" => 475, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 97, "poin" => 485, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 98, "poin" => 485, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 99, "poin" => 490, "tipe" => "Reading"]);
        $this->tes->add_data("nilai_toeic", ["soal" => 100, "poin" => 495, "tipe" => "Reading"]);
    }

    public function add_sertifikat_toefl(){
        $data = $this->tes->add_sertifikat_toefl();
        echo json_encode($data);
    }

    public function get_peserta_toeic(){
        $data = $this->tes->get_peserta_toeic();
        echo json_encode($data);
    }

    public function edit_peserta_toeic(){
        $data = $this->tes->edit_peserta_toeic();
        echo json_encode($data);
    }

    public function add_sertifikat_toeic(){
        $data = $this->tes->add_sertifikat_toeic();
        echo json_encode($data);
    }
}

/* End of file Tes.php */
