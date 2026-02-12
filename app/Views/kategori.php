<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="card">
      <div class="card-header">
        <a href="<?= base_url('kategori/add') ?>" class="btn btn-sm btn-outline-secondary">Add Category</a>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>

      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID Category</th>
              <th>Category Name</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
          <?php foreach($kat as $katlist): ?>
            <tr>
              <td><?= $katlist['id_kategori'] ?></td>
              <td><?= $katlist['nama_kategori'] ?></td>
              <td>
                <!-- EDIT BUTTON -->
                <a href="<?= base_url('kategori/'.$katlist['id_kategori'].'/edit') ?>"
                   class="btn btn-sm btn-outline-secondary">
                   Edit
                </a>

                <!-- DELETE BUTTON (FIXED) -->
                <a href="#"
                   data-href="<?= base_url('kategori/'.$katlist['id_kategori'].'/delete') ?>"
                   onclick="confirmToDelete(this); return false;"
                   class="btn btn-sm btn-outline-danger">
                   Delete
                </a>
              </td>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      </div>

      <div class="card-footer">
        Arunika Brew
      </div>
    </div>

  </section>
</div>

<!-- ================= MODAL CONFIRM DELETE ================= -->
<div id="confirm-dialog" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <p>Are you sure you want to delete this category?</p>
        <small class="text-danger">This data cannot be recovered!</small>
      </div>

      <div class="modal-footer">
        <a href="#" id="delete-button" class="btn btn-danger">Delete</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>

<!-- ================= JAVASCRIPT CONFIRM DELETE ================= -->
<script>
function confirmToDelete(el) {
    var url = el.getAttribute("data-href");
    document.getElementById("delete-button").setAttribute("href", url);
    $('#confirm-dialog').modal('show');
}
</script>