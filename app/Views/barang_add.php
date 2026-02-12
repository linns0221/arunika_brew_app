<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                    <h1>Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Menu</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Menu Form</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kode_barang">Item Code</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $barang ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori">Category</label>
                        <select name="id_kategori" id="id_kategori" class="form-control" >
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Item Name</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Enter Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Image</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept=".jpg,.jpeg,.png">
                    </div>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
