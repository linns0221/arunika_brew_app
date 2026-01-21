<div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="<?= base_url() . "/file_gambar/" . $brg['gambar']; ?>" alt="Image">
                        </div>
                        
                    </div>
                </div>
            </div>
            <form action="<?= base_url('cartAdd') ?>" method="post">
            <div class="col-lg-12 pb-5">
                <h3 class="font-weight-semi-bold"><?= $brg['nama_barang'] ?></h3>
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Warna:</p>
                    <select name="id_item" class="form-control">
                        <?php foreach($item as $itemlist): ?>
                                <option value="<?= $itemlist['id_item'] ?>"><?= $itemlist['warna'].' ('.number_to_currency($itemlist['harga'], 'IDR', 'en_ID', 2).")"; ?></option>
                        <?php endforeach ?>
                    </select>
                    
                </div>
                
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <input type="text" name="jumlah" class="form-control bg-secondary text-center" value="1">
                    </div>
                    
                    <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                </div>
                </form>
            </div>
        </div>
        
    </div>
