<div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Kategori</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                                    <a href="<?= base_url('kategoribuku') ?>" class="nav-item nav-link">
                                        Semua Kategori
                                    </a>
                            <?php foreach($kat as $katlist): ?>
                                    <a href="<?= base_url('kategoribuku/'.$katlist['id_kategori'].'/view') ?>" class="nav-item nav-link">
                                        <?= $katlist['nama_kategori'] ?>
                                    </a>
                            <?php endforeach ?>
                            
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="<?= base_url(); ?>" class="nav-item nav-link active">Home</a>
                            <a href="<?= base_url('contact'); ?>" class="nav-item nav-link">Contact</a>
                        </div>
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
                    </div>
                </nav>
                <?php if ($statushalaman== 'beranda'){ ?>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    <?php
                        $statuscrs='active'; 
                        foreach($crs as $crslist): ?>
                        <div class="carousel-item <?= $statuscrs; ?>" style="height: 410px;">
                            <img class="img-fluid" src="<?= base_url('template/img/'.$crslist['pic_carousel'])?>" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3"><?= $crslist['desc_carousel'] ?></h4>
                                    
                                </div>
                            </div>
                        </div>
                        <?php
                            $statuscrs='';
                            endforeach ?>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
