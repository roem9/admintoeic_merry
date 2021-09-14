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
                    </div>
                    <span class="dropdown mt-3">
                        <button class="btn btn-success dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                            <?= tablerIcon("file-export", "me-1")?>
                            Export
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="<?= base_url()?>tes/export/hasil/<?= $id?>">
                                <?= tablerIcon("report", "me-1")?>
                                Hasil Tes
                            </a>
                        </div>
                    </span>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <table id="dataTable" class="table card-table table-vcenter text-nowrap text-dark">
                                <thead>
                                    <tr>
                                        <th class="text-dark desktop mobile-l mobile-p tablet-l tablet-p" style="font-size: 11px">Nama Peserta</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Email</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Benar</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Nilai</th>
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
        let tipe = "<?= $tipe?>";
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