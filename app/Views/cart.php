<div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Items</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php 
                            $total=0;
                            foreach($detail as $brglist): ?>
                        <?php
                            $subtotal=$brglist['harga']*$brglist['jumlah'];
                            $total=$total+$subtotal;
                        ?>
                        <tr>
                            <td align="left"><img src="<?= base_url() . "/file_gambar/" . $brglist['gambar']; ?>" alt="" style="width: 50px;"> <?= $brglist['nama_barang'] ?></td>
                            <td class="align-middle"><?= $brglist['harga'] ?></td>
                            <td class="align-middle"><?= $brglist['jumlah'] ?></td>
                            <td class="align-middle"><?= $subtotal ?></td>
                            <td class="align-middle">
                                <a href="#" data-href="<?= base_url('cart/'.$brglist['id_detail'].'/delete') ?>" onclick="confirmToDelete(this)" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold"><?= number_to_currency($total, 'IDR', 'en_ID', 2) ?></h5>
                        </div>
                        <a href="#" data-href="<?= base_url('checkout') ?>" onclick="confirmToProceed(this)" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h2 class="h2">Are You Sure?</h2>
        <p>This order will be removed. Do you want to proceed?</p>
      </div>
      <div class="modal-footer">
        <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div id="proceed-dialog" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h2 class="h2">Order Confirmation</h2>
        <p>Please confirm your order details to continue</p>
      </div>
      <div class="modal-footer">
        <a href="#" role="button" id="proceed-button" class="btn btn-danger">Proceed</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<script>
function confirmToDelete(el){
    $("#delete-button").attr("href", el.dataset.href);
    $("#confirm-dialog").modal('show');
}
function confirmToProceed(el){
    $("#proceed-button").attr("href", el.dataset.href);
    $("#proceed-dialog").modal('show');
}
</script>
