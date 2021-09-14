<?php $this->load->view("_partials/header-signin");?>

    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="."><img src="<?= base_url()?>assets/img/logo.png" height="90" alt=""></a>
            </div>
            <form class="card card-md" action="<?= base_url()?>auth/login" method="post" autocomplete="off">
                <div class="card-body">
                <h2 class="card-title text-center mb-4">Welcome</h2>
                
                <?php if( $this->session->flashdata('pesan') ) : ?>
                    <div class="col-12">
                        <?=$this->session->flashdata('pesan')?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username">
                </div>
                <div class="mb-2">
                    <label class="form-label">
                    Password
                    </label>
                    <div class="input-group input-group-flat">
                    <input type="password" name="password" class="form-control"  placeholder="Password"  autocomplete="off">
                    <span class="input-group-text">
                        <a href="javascript:void(0)" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                        <svg width="24" height="24" id="showPassword">
                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-eye" />
                        </svg>
                        <svg width="24" height="24" id="hidePassword">
                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-eye-off" />
                        </svg>
                        </a>
                    </span>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember"/>
                    <span class="form-check-label">Remember me on this device</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        
        // $("#showPassword").click(function(){
        //     $("input[name='password']").prop({type:"text"});
        // })

        $("#hidePassword").hide();
    
        $("#showPassword").click(function(){
        $("input[name='password']").prop('type', 'text');
        $("#showPassword").hide();
        $("#hidePassword").show()
        })
        
        $("#hidePassword").click(function(){
        $("input[name='password']").prop('type', 'password');
        $("#showPassword").show();
        $("#hidePassword").hide()
        })

    </script>

<?php $this->load->view("_partials/footer-signin");?>