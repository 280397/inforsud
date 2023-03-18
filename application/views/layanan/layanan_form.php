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
                        <?= form_open_multipart($action) ?>
                        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="card-body">
                                <?= $this->session->flashdata('message'); ?>
                                <div class="form-group">
                                    <label for="judul">Judul *</label>
                                    <input type="text" class="form-control" name="judul" value="<?= $judul ?>" id="judul">
                                    <?= form_error('judul', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="ket">Keterangan *</label>
                                    <textarea id="ket" name="ket"><?= $ket ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="img">Foto </label>
                                    <?php if ($img != null) { ?>

                                        <img src="<?= base_url('gambar/layanan/' . $img) ?>" style="width:400px">
                                    <?php } ?> <br><br>
                                    <input type="file" name="img" class="form-control" id="img" />

                                </div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                <a href="<?php echo site_url('Layanan') ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                        <script>
                            CKEDITOR.replace('ket');
                        </script>
                        <?= form_close() ?>
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>