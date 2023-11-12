<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- @autor Pavle Smakic 2019/0347
         @autor Marta Andjic 2020/0343   
         @autor Andreja Djokic 2020/0274
    -->
    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="/assets/img/pejzazok.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase">Come and Explore</h5>
                            <h1 class="display-1 text-white mb-md-4">Welcome to virtual zoo</h1>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid bg-secondary p-0" id="skok">
        <div class="row g-0">
            
            <div class="col-lg-6 py-6 px-5">
                <h1 class="display-5 mb-4">Hi I am <span class="bojaatrakcijewater">
                    <?php echo $atrakcija->getNaziv()?>
                    </span></h1>
                <h4 class="bojaatrakcije mb-4"><?php echo $atrakcija->getNaziv()?></h4>
                <p class="mb-4"><?php echo $atrakcija->getOpis()?></p>
                <?php if ($role == 'Gost'): ?>
                    <a href="<?= site_url("Gost/zivotinja/{$atrakcija->getIdZivotinja()}")?>" class="btn bojaatrakcijedugme py-md-3 px-md-5 rounded-pill">Visit</a>
                <?php elseif ($role == 'korisnik'): ?>
                    <a href="<?= site_url("Korisnik/zivotinja/{$atrakcija->getIdZivotinja()}")?>" class="btn bojaatrakcijedugme py-md-3 px-md-5 rounded-pill">Visit</a>
                <?php elseif ($role == 'moderator'): ?>
                    <a href="<?= site_url("Moderator/zivotinja/{$atrakcija->getIdZivotinja()}")?>" class="btn bojaatrakcijedugme py-md-3 px-md-5 rounded-pill">Visit</a>
                <?php elseif ($role == 'admin'): ?>
                    <a href="<?= site_url("Admin/zivotinja/{$atrakcija->getIdZivotinja()}")?>" class="btn bojaatrakcijedugme py-md-3 px-md-5 rounded-pill">Visit</a>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 ">
                <div class="h-100 d-flex flex-column justify-content-center atrakcijadana p-5">
                    <div class="d-flex text-white mb-5 text-center justify-content-center">
                        <img src="/assets/img/zivotinja/<?php echo $atrakcija->getNaslovnaSlika()?>" alt="" class="img-fluid" style="width: 100%">
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
    <!-- About End -->
    

    <!-- Services Start -->
    <div class="container-fluid pt-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">Landscapes</h1>
            <br>
            <div class="row">
                <div class="mb-3 text-center">
                    <?php if ($role == 'korisnik'): ?>
                        <a href="Editor/dodaj_predeo"> <button class="zaokruzi btn btn-secondary">Add landscape</button></a>
                    <?php endif; ?>
                </div>
            </div>
            <hr class="w-25 mx-auto bg-primary">
        </div>
        <div class="row g-5">
            <?php foreach($land as $item){ ?> 
            <div class="col-lg-4 col-md-6 text-center">
                <?php if ($role === 'gost'):  ?>
                <a href="<?= site_url("Gost/predeo/{$item->getIdPredeo()}")?>">
                    <h3 class="mb-3"><?php echo $item->getNaziv(); ?></h3>
                    <div class="service-item bg-secondary text-center px-5"
                         style="border: 2px solid #ccc;
                                background-image: url(<?php echo '/assets/img/predeo/'.$item->getSlika(); ?>); background-size: cover;">
                    </div>
                </a>
                <?php elseif ($role == 'korisnik'): ?>
                <a href="<?= site_url("Korisnik/predeo/{$item->getIdPredeo()}")?>">
                    <h3 class="mb-3"><?php echo $item->getNaziv(); ?></h3>
                    <div class="service-item bg-secondary text-center px-5"
                         style="border: 2px solid #ccc;
                                background-image: url(<?php echo '/assets/img/predeo/'.$item->getSlika(); ?>); background-size: cover;">
                    </div>
                </a>
                 <?php elseif ($role == 'moderator'): ?>
                <a href="<?= site_url("Moderator/predeo/{$item->getIdPredeo()}")?>">
                    <h3 class="mb-3"><?php echo $item->getNaziv(); ?></h3>
                    <div class="service-item bg-secondary text-center px-5"
                         style="border: 2px solid #ccc;
                                background-image: url(<?php echo '/assets/img/predeo/'.$item->getSlika(); ?>); background-size: cover;">
                    </div>
                </a>
                 <?php elseif ($role == 'admin'): ?>
                <a href="<?= site_url("Admin/predeo/{$item->getIdPredeo()}")?>">
                    <h3 class="mb-3"><?php echo $item->getNaziv(); ?></h3>
                    <div class="service-item bg-secondary text-center px-5"
                         style="border: 2px solid #ccc;
                                background-image: url(<?php echo '/assets/img/predeo/'.$item->getSlika(); ?>); background-size: cover;">
                    </div>
                </a>
                <?php endif; ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <br>
    

<?= $this->endSection() ?>