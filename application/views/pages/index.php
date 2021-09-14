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
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <!-- <textarea class='ckeditor' id='ckedtor'></textarea> -->
                    <div id="skeleton">
                        <div class="row">
                            <li class="list-group-item mb-3">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="skeleton-line"></div>
                                        <div class="skeleton-line"></div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item mb-3">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="skeleton-line"></div>
                                        <div class="skeleton-line"></div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item mb-3">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="skeleton-line"></div>
                                        <div class="skeleton-line"></div>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </div>

                    <div class="row row-cards" data-masonry='{"percentPosition": true }' id="dataAjax">
                        <div class="col-12 col-sm-4">
                            <div class="card">
                                <div class="card-body p-2 text-center">
                                    <div class="h1 m-0 Count"><?= $soal?></div>
                                    <div class="text-muted mb-3">Soal</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="card">
                                <div class="card-body p-2 text-center">
                                    <div class="h1 m-0 Count"><?= $tes?></div>
                                    <div class="text-muted mb-3">Tes</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="card">
                                <div class="card-body p-2 text-center">
                                    <div class="h1 m-0 Count"><?= $peserta?></div>
                                    <div class="text-muted mb-3">Peserta</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Paginate -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-3" id='pagination'></div>
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

    <!-- load javascript -->
    <?php  
        if(isset($js)) :
            foreach ($js as $i => $js) :?>
                <script src="<?= base_url()?>assets/myjs/<?= $js?>"></script>
                <?php 
            endforeach;
        endif;    
    ?>

    <script>
        $("#Dashboard").addClass("active bg-blue-lt")
    </script>
<?php $this->load->view("_partials/footer")?>