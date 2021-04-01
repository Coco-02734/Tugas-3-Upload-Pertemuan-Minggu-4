<div class="container-fluid" id="container-wrapper">
    <?= $this->session->flashdata('message'); ?>
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>ID Produk</th>
                                <th>Foto Produk</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Atur</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <?php foreach ($produk as $a) : ?>
                                <tr>
                                    <th>MA<?= $a['id_produk']; ?></th>
                                    <th><img class="img-fluid" width="100px" src="<?= base_url('assets/img/foto_produk/') . $a['gambar']; ?>" alt=""></th>
                                    <th><?= $a['nama_produk']; ?></th>
                                    <th><?= $a['harga']; ?></th>
                                    <th><?= $a['stok']; ?></th>
                                    <th>
                                        <h4><span class="badge badge-warning">Edit</span></h4>
                                    </th>
                                </tr>
                            <?php endforeach; ?>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>