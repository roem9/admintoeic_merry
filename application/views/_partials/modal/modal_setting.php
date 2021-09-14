<div class="modal modal-blur fade" id="pengaturanAkun" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengaturan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_admin" class="form required">
                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" readonly>
                    <label>Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="password" class="form form-control">
                    <label>Password</label>
                    <small class="form-text text-danger">Kosongkan Field ini jika tidak ingin mengubah password</small>
                </div>
                <div class="form-floating mb-3">
                    <input type="color" name="background" class="form form-control required">
                    <label>Warna Background</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="no_wa" class="form form-control required number">
                    <label>No WA</label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-auto mr-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success btnEdit">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="editPoin" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nilai Listening</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="poin"></div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-auto mr-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success btnEdit">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="editPoinToeic" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nilai Listening</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="poin"></div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-auto mr-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success btnEdit">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="editLogo" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush">
                    <div class="gallery"></div>
                </div>
                <div class="alert alert-important alert-info alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg width="24" height="24" class="alert-icon">
                                <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-info-circle" />
                            </svg>
                        </div>
                        <div>
                            Anda dapat mengubah logo dengan mengupload file melalui form berikut
                        </div>
                    </div>
                </div>
                <form method="post" action="" enctype="multipart/form-data" class="myform">
                    <input type="hidden" name="id_agency">
                    <div class="form-floating mb-3">
                        <input type="file" name="file" class="form-control required">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn ms-3 btn-primary btnUpload">Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>