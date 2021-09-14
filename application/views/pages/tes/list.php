<?php $this->load->view("_partials/header")?>
    <div class="wrapper">
        <div class="sticky-top">
            <?php $this->load->view("_partials/navbar-header")?>
            <?php $this->load->view("_partials/navbar")?>
        </div>
        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                        <h2 class="page-title">
                            <?= $title?>
                        </h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#addTes">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                Tambahkan Tes
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#addTes" aria-label="Create new report">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <table id="dataTable" class="responsive table card-table table-vcenter text-nowrap text-dark">
                                <thead>
                                    <tr>
                                        <th class="text-dark desktop mobile-l mobile-p tablet-l tablet-p" style="font-size: 11px">Nama Tes</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Tgl Tes</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Tgl Pengumuman</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Soal</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Peserta</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Status</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Menu</th>
                                        <th class="text-dark none" style="font-size: 11px">Password</th>
                                        <th class="text-dark none" style="font-size: 11px">Link</th>
                                        <th class="text-dark none" style="font-size: 11px">Catatan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <?php $this->load->view("_partials/footer-bar")?>
        </div>
    </div>

    <!-- load modal -->
    <?php 
        if(isset($modal)) :
            foreach ($modal as $i => $modal) {
                $this->load->view("_partials/modal/".$modal);
            }
        endif;
    ?>

    <script>
        $("#Tes").addClass("active")
    </script>

    <!-- load javascript -->
    <?php  
        if(isset($js)) :
            foreach ($js as $i => $js) :?>
                <script src="<?= base_url()?>assets/myjs/<?= $js?>"></script>
                <?php 
            endforeach;
        endif;    
    ?>
    
<?php $this->load->view("_partials/footer")?>