<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Kategori</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Data Kategori</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Kategori</h4>
                            <div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                                    Create
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="satuan" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th width="80px">No</th>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                    <a href="<?= site_url('Kategori') ?>" class="btn btn-secondary">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>