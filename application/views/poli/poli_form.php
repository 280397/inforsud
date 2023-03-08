<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $page ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item"><?= $page ?></div>
            </div>
        </div>

        <div class="section-body col-xs-12">
            <h2 class="section-title"><?= $page ?></h2>
            <p class="section-lead">

            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="<?php echo $action; ?>" method="post">
                            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="nama_poli">Nama Poli *</label>
                                        <input type="text" class="form-control" name="nama_poli" id="nama_poli" value="<?= $nama_poli ?>" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan *</label>
                                        <textarea id="keterangan" name="keterangan" required autofocus><?= $keterangan ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_buka">Jam Buka *</label>
                                        <input type="time" class="form-control" name="jam_buka" id="jam_buka" value="<?= $jam_buka ?>" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_tutup">Jam tutup *</label>
                                        <input type="time" class="form-control" name="jam_tutup" id="jam_tutup" value="<?= $jam_tutup ?>" required autofocus>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                    <a class="btn btn-secondary" href="<?php echo site_url('Poli') ?>" role="button">Cancel</a>
                                </div>
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
        </div>

    </section>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>