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
                            <div class="col-12 col-md-4">
                                <div class="card">
                                <div class="ratio ratio-21x9 card-img-top">
                                    <div class="skeleton-image"></div>
                                </div>
                                <div class="card-body">
                                    <div class="skeleton-heading"></div>
                                    <div class="skeleton-line"></div>
                                    <div class="skeleton-line"></div>
                                </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card">
                                <div class="ratio ratio-21x9 card-img-top">
                                    <div class="skeleton-image"></div>
                                </div>
                                <div class="card-body">
                                    <div class="skeleton-heading"></div>
                                    <div class="skeleton-line"></div>
                                    <div class="skeleton-line"></div>
                                </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card">
                                <div class="ratio ratio-21x9 card-img-top">
                                    <div class="skeleton-image"></div>
                                </div>
                                <div class="card-body">
                                    <div class="skeleton-heading"></div>
                                    <div class="skeleton-line"></div>
                                    <div class="skeleton-line"></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row row-cards" data-masonry='{"percentPosition": true }' id="dataAjax">
                        <div class="col-12 col-sm-4">
                            <div class="card">
                                <div class="card-body p-2 text-center">
                                    <div class="text-end text-green">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                        6% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 17 9 11 13 15 21 7" /><polyline points="14 7 21 7 21 14" /></svg>
                                    </span>
                                    </div>
                                    <div class="h1 m-0">43</div>
                                    <div class="text-muted mb-3">New Tickets</div>
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
        activeMenu("<?= $menu?>");
    </script>
<?php $this->load->view("_partials/footer")?>