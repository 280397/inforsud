<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Poli</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Data Poli</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Poli</h4>
                            <div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    Create
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="poli" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Nama Poli</th>
                                            <th>Jam Buka</th>
                                            <th>Jam Tutup</th>
                                            <th width="200px">Action</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= $action ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_poli">Nama Poli *</label>
                        <input type="text" class="form-control" name="nama_poli" id="nama_poli" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan *</label>
                        <textarea id="keterangan" name="keterangan" required autofocus><?= $keterangan ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jam_buka">Jam Buka *</label>
                        <input type="time" class="form-control" name="jam_buka" id="jam_buka" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="jam_tutup">Jam tutup *</label>
                        <input type="time" class="form-control" name="jam_tutup" id="jam_tutup" required autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <script>
                    var editor = CKEDITOR.replace('keterangan', {
                        startupFocus: true,
                        extraPlugins: 'notification'
                    });

                    editor.on('required', function(evt) {
                        editor.showNotification('Silakan Isi Keterangan', 'warning');
                        evt.cancel();
                    });
                </script>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>