<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('transaksi'); ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Informasi Transaksi -->
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Informasi Transaksi</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="200">ID Transaksi</th>
                        <td>: <?= $transaksi['id_transaksi']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <td>: <?= date('d M Y', strtotime($transaksi['tgl_transaksi'])); ?></td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td>: <?= $transaksi['username']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Detail Item Transaksi -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Item</h3>
            </div>

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $total = 0;
                            $no = 1;
                            foreach ($detail as $transaksiList):
                                $subtotal = $transaksiList['harga'] * $transaksiList['jumlah'];
                                $total += $subtotal;
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $transaksiList['nama_barang']; ?></td>
                            <td>Rp <?= number_format($transaksiList['harga'], 0, ',', '.'); ?></td>
                            <td><?= $transaksiList['jumlah']; ?></td>
                            <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Total Biaya</th>
                            <th>Rp <?= number_format($total, 0, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="card-footer text-right">
                <a href="<?= base_url('transaksi'); ?>" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </div>

    </section>
</div>
