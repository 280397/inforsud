<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Data Artikel</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Artikel</h4>
                            <div>
                                <?php echo anchor(site_url('Artikel/create'), 'Create', 'class="btn btn-primary"'); ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="artikel" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
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
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create kategori</h5>

            </div>
            <form action="<?php echo site_url('Kategori/create_action') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Kategori *</label>
                        <input type="text" class="form-control" name="nama" id="nama" required autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="<?= site_url('Artikel') ?>" class="btn btn-secondary">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>