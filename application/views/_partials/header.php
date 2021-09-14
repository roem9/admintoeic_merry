<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta2
* @link https://tabler.io
* Copyright 2018-2021 The Tabler Authors
* Copyright 2018-2021 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0 viewport-fit=cover" /> -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    
    <link rel="icon" href="<?= base_url()?>assets/img/logo.png?t=<?= time()?>" type="image/icon type">

    <title>Admin - <?= $title?></title>

    <script src="<?= base_url()?>assets/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= base_url()?>assets/jquery/sweetalert2@9.js"></script>
    <!-- jquery ui  -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

    <!-- CSS files -->
    <link href="<?= base_url()?>assets/css/tabler.min.css" rel="stylesheet"/>
    <link href="<?= base_url()?>assets/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="<?= base_url()?>assets/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="<?= base_url()?>assets/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="<?= base_url()?>assets/css/demo.min.css" rel="stylesheet"/>
    <link href="<?= base_url()?>assets/tabler-icons-1.39.1/iconfont/tabler-icons.min.css" rel="stylesheet"/>

    <link href="<?= base_url()?>assets/mycss/style.css" rel="stylesheet"/>

    <script type="text/javascript" src="<?= base_url()?>assets/ckeditor/ckeditor.js"></script>
    <!-- <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script> -->

     <!-- data table  -->
    <link href="<?= base_url()?>assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?= base_url()?>assets/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url()?>assets/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

    <!-- <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet">

    <!-- clipboard  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    
    <script> 
      var url_base = "<?= base_url()?>"; 
      var logo = "<?= $this->session->userdata('id_admin')?>"; 
    </script>
  </head>
  <body class="antialiased">