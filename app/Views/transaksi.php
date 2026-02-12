<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
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
          <h3 class="card-title">Order List</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>User</th>
                <th>Date</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transaksi as $transaksiList): ?>
                <tr>
                    <td><?= $transaksiList['id_transaksi']; ?></td>
                    <td><?= $transaksiList['username']; ?></td>
                    <td><?= date('d M Y', strtotime($transaksiList['tgl_transaksi'])); ?></td>
                    <td><?= "Rp " . number_format($transaksiList['total_biaya'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="<?= base_url('transaksi/' . $transaksiList['id_transaksi'] . '/detail'); ?>"
                           class="btn btn-sm btn-outline-secondary">
                           Details
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="h2">Are you sure?</h2>
                <p>This data will be permanently deleted</p>
            </div>
            <div class="modal-footer">
                <a href="#" role="button" id="delete-button" class="btn btn-danger">
                    Delete
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function confirmToDelete(el) {
    $("#delete-button").attr("href", el.dataset.href);
    $("#confirm-dialog").modal("show");
}
</script>
