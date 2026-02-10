<form method="post" action="<?= base_url('cart/'.$idtrans.'/finishTrans') ?>">

<div class="container-fluid pt-5">
    <div class="row px-xl-5">

        <!-- LEFT -->
        <div class="col-lg-8">
            <h4 class="font-weight-semi-bold mb-4">Billing</h4>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Name</label>
                    <input class="form-control" type="text" name="nama_lengkap" 
                        placeholder="Your name is required" required>
                </div>

                <div class="col-md-6 form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email"
                        placeholder="(optional)">
                </div>

                <div class="col-md-6 form-group">
                    <label>Phone</label>
                    <input class="form-control" type="text" name="no_hp"
                        placeholder="(optional)">
                </div>

                <div class="col-md-12 form-group">
                    <label>Table Number</label>
                    <input class="form-control" type="text" name="no_meja" 
                        placeholder="Table number must be a number" required>
                </div>

                <div class="col-md-12 form-group">
                    <label>Notes</label>
                    <input class="form-control" type="text" name="catatan"
                        placeholder="(optional)">
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="col-lg-4">

            <!-- PAYMENT -->
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Payment</h4>
                </div>

                <div class="card-body">

                    <!-- CASH -->
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                class="custom-control-input"
                                name="payment"
                                id="cod"
                                value="COD"
                                checked
                            >
                            <label class="custom-control-label" for="cod">
                                Cash
                            </label>
                        </div>
                    </div>

                    <!-- QRIS -->
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                class="custom-control-input"
                                name="payment"
                                id="qris"
                                value="QRIS"
                            >
                            <label class="custom-control-label" for="qris">
                                QRIS
                            </label>
                        </div>
                    </div>

                    <!-- QRIS IMAGE (ONLY IMAGE) -->
                    <div id="qrisBox" class="mt-4 text-center d-none">
                        <img
                            src="<?= base_url('file_gambar/qris.png'); ?>"
                            alt="QRIS"
                            class="img-fluid mx-auto d-block"
                            style="max-width: 220px;"
                        >
                    </div>

                </div>

                <div class="card-footer border-secondary bg-transparent">
                    <button
                        type="submit"
                        class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">
                        Send Order to Barista
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const codRadio  = document.getElementById('cod');
    const qrisRadio = document.getElementById('qris');
    const qrisBox   = document.getElementById('qrisBox');

    function toggleQRIS() {
        if (qrisRadio.checked) {
            qrisBox.classList.remove('d-none');
        } else {
            qrisBox.classList.add('d-none');
        }
    }

    codRadio.addEventListener('change', toggleQRIS);
    qrisRadio.addEventListener('change', toggleQRIS);

    toggleQRIS(); // kondisi awal
});
</script>
