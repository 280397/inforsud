<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Layanan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Data Layanan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Layanan</h4>
                            <div>
                                <?php echo anchor(site_url('Layanan/create'), 'Create', 'class="btn btn-primary"'); ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="layanan" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Judul</th>
                                            <th>Foto</th>
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


<?php $this->load->view('dist/_partials/footer'); ?>