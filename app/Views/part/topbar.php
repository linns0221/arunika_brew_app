<?php
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;

$jmlitem = 0;
if(session()->get('id_user')) {
    $userID = session()->get('id_user');
    $transaksi = new TransaksiModel();
    $detail = new DetailTransaksiModel();

    $cek = $transaksi->where('id_user', $userID)
                     ->where('status', 'pending')
                     ->first();

    if($cek) {
        $jmlitem = $detail->countDataWithCriteria($cek['id_transaksi']);
    }
}
?>


<!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container">

            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url(); ?>">
                <img 
                    src="<?= base_url('/file_gambar/logo3.png'); ?>" 
                    style="height: 36px; margin-right: 10px;"
                >
                <img 
                    src="<?= base_url('/file_gambar/typography4.jpeg'); ?>" 
                    style="height: 36px; margin-right: 10px;"
                >
            </a>

            <!-- TOGGLER -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENU -->
            <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                <ul class="navbar-nav">

                    <!-- DROPDOWN MENU -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           href="<?= base_url('kategoribuku'); ?>"
                           id="menuDropdown"
                           data-toggle="dropdown">
                            Menu
                        </a>

                        <div class="dropdown-menu custom-dropdown">
                            <a class="dropdown-item" href="<?= base_url('kategoribuku'); ?>">
                                All Categories
                            </a>
                            <a class="dropdown-item" href="<?= base_url('kategoribuku/17/view'); ?>">
                                Beverages
                            </a>
                            <a class="dropdown-item" href="<?= base_url('kategoribuku/18/view'); ?>">
                                Pastry
                            </a>
                        </div>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="<?= base_url('tentang'); ?>">About</a></li>
                    <div class="navbar-nav ml-auto py-0">
                        <?php
                            if (session()->get('username') == ''){
                                echo "<a href='".base_url('login')."' class='nav-item nav-link'>Login</a>";
                                echo "<a href='".base_url('register')."' class='nav-item nav-link'>Register</a>";
                            }else{
                                echo "<a href='#' class='nav-item nav-link'>Halo, ".session()->get('username')."</a>";
                                echo "<a href='".base_url('logout')."' class='nav-item nav-link'>[ Logout ]</a>";
                            }
                        ?>
                    </div>


                </ul>
            </div>

           <div class="col-lg-3 col-6 text-right">
                <a href="cart" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge"><?= $jmlitem ?></span>
                </a>
            </div>

        </div>
    </nav>