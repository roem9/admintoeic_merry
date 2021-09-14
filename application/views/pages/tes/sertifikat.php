<?php
    function day($n) {
        $n = intval($n);
        if ($n >= 11 && $n <= 13) {
            return "{$n}<sup>th</sup>";
        }
        switch ($n % 10) {
            case 1:  return "{$n}<sup>st</sup>";
            case 2:  return "{$n}<sup>nd</sup>";
            case 3:  return "{$n}<sup>rd</sup>";
            default: return "{$n}<sup>th</sup>";
        }
    }

    function tgl_sertifikat($tgl){
        $data = explode("-", $tgl);
        $hari = $data[0];
        $bulan = $data[1];
        $tahun = $data[2];

        if($bulan == "01") $bulan = "January";
        if($bulan == "02") $bulan = "February";
        if($bulan == "03") $bulan = "March";
        if($bulan == "04") $bulan = "April";
        if($bulan == "05") $bulan = "May";
        if($bulan == "06") $bulan = "June";
        if($bulan == "07") $bulan = "July";
        if($bulan == "08") $bulan = "August";
        if($bulan == "09") $bulan = "September";
        if($bulan == "10") $bulan = "October";
        if($bulan == "11") $bulan = "November";
        if($bulan == "12") $bulan = "December";

        return $hari . " " . $bulan . " " . $tahun;
    }
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        * {
            margin: 0;
            padding: 0;
        }

        .qrcode{
            width: 210px;
			position: absolute;
            left: 44px;
			bottom: 40px;
            font-size: 35px;
            word-spacing: 3px;
        }

        .nama{
            /* background-color: red; */
            width: 600px;
			position: absolute;
            left: 100px;
			top: 200px;
            font-size: 26px;
            font-family: 'Roboto', sans-serif;
            word-spacing: 3px;
        }

        .ttl{
            /* background-color: red; */
            width: 600px;
			position: absolute;
            left: 165px;
			top: 238px;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
            word-spacing: 3px;
        }

        .t4{
            /* background-color: red; */
			position: absolute;
            <?php if(strlen($t4_lahir) < 12 ) echo 'width: 129px;';?>
            /* right: 229px; */
            left : 888px;
			top: 355px;
            font-size: 18px;
            font-family: 'rock';
            word-spacing: 3px;
        }
        
        .listening{
            /* background-color: yellow; */
            width: 120px;
			position: absolute;
            left: 450px;
			top: 328px;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
            word-spacing: 3px;
        }
        
        .structure{
            /* background-color: blue; */
            width: 120px;
			position: absolute;
            left: 450px;
			top: 349px;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
            word-spacing: 3px;
        }
        
        .reading{
            /* background-color: red; */
            width: 120px;
			position: absolute;
            left: 450px;
			top: 369px;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
            word-spacing: 3px;
        }
        
        .nilai{
            /* background-color: green; */
            width: 120px;
			position: absolute;
            left: 450px;
			top: 388px;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
            word-spacing: 3px;
        }

        .tgl{
            /* background-color: red; */
			position: absolute;
            left: 254px;
			bottom: 61px;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
            word-spacing: 3px;
        }

        .tgl_akhir{
            /* background-color: red; */
			position: absolute;
            left: 254px;
			bottom: 43px;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
            word-spacing: 3px;
        }

        .tgl_tes{
            /* background-color: red; */
			position: absolute;
            left: 606px;
			bottom: 109px;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
            word-spacing: 3px;
        }

        .no_doc{
            /* background-color: red; */
            width: 200px;
			position: absolute;
            left: 380px;
			top: 148px;
            font-size: 13px;
            font-family: 'Roboto', sans-serif;
            word-spacing: 3px;
        }

        .gender{
            width: 129px;
			position: absolute;
            left: 373px;
			top: 407px;
            font-size: 18px;
            font-family: 'rock';
            word-spacing: 3px;
        }

        .country{
            width: 129px;
			position: absolute;
            left: 631px;
			top: 407px;
            font-size: 18px;
            font-family: 'rock';
            word-spacing: 3px;
        }

        .language{
            width: 129px;
			position: absolute;
            right: 210px;
			top: 407px;
            font-size: 18px;
            font-family: 'rock';
            word-spacing: 3px;
        }

        @page :first {
            background-image: url("<?= base_url()?>assets/img/sertifikat.jpg");
            background-image-resize: 6;
        }
        
    </style>
</head>
    <body style="text-align: center">
        <div class="qrcode">
            <img src="<?= base_url()?>assets/qrcode/<?= $id?>.png" width=135 alt="">
        </div>
        <div class="nilai"><p style="text-align: right; margin: 0px"><b><?= round($skor)?></b></p></div>
        <div class="nama"><p style="text-align: center; margin: 0px"><b><u><?= $nama?></u></b></p></div>
        <div class="ttl"><p style="text-align: center; margin: 0px"><b><?= tgl_sertifikat(date("d-m-Y", strtotime($tgl_lahir)))?></b></p></div>
        <div class="t4"><p style="text-align: center; margin: 0px;"><?= $t4_lahir?></p></div>
        <!-- <div class="gender"><p style="text-align: center; margin: 0px"><?= $jk?></p></div>
        <div class="country"><p style="text-align: center; margin: 0px"><?= $country?></p></div>
        <div class="language"><p style="text-align: center; margin: 0px"><?= $language?></p></div> -->
        <div class="listening"><p style="text-align: right; margin: 0px"><b><?= $listening?></b></p></div>
        <div class="structure"><p style="text-align: right; margin: 0px"><b><?= $structure?></b></p></div>
        <div class="reading"><p style="text-align: right; margin: 0px"><b><?= $reading?></b></p></div>
        <div class="no_doc"><p style="margin: 0px"><?= $no_doc?></p></div>
        <div class="tgl"><p style="text-align: center; margin: 0px"><?= date("d/m/y", strtotime($tgl_tes))?></p></div>
        <div class="tgl_akhir"><p style="text-align: center; margin: 0px"><?= date("d/m/y", strtotime('+1 years', strtotime($tgl_tes)))?></p></div>
        <div class="tgl_tes"><p style="text-align: center; margin: 0px"><?= tgl_sertifikat(date("d-m-Y", strtotime($tgl_tes)))?></p></div>
    </body>
</html>