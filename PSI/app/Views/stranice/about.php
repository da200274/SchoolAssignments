<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <!-- @autor Pavle Smakic 2019/0347 -->
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">About Us</h1>
                
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Team Start -->
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">Our Team Members</h1>
            <hr class="w-25 mx-auto bg-primary">
        </div>
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="/assets/img/kit.jpg" alt="">
                    <div class="team-text w-100 position-absolute top-50 text-center dodajboju p-4">
                        <h3 class="text-white">Marta Andjic</h3>
                        <p class="text-white text-lowercase mb-0">email</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="/assets/img/kit.jpg" alt="">
                    <div class="team-text w-100 position-absolute top-50 text-center dodajboju p-4">
                        <h3 class="text-white">Andreja Djokic</h3>
                        <p class="text-white text-lowercase mb-0">email</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="/assets/img/kit.jpg" alt="">
                    <div class="team-text w-100 position-absolute top-50 text-center dodajboju p-4">
                        <h3 class="text-white">Dimitrije Jelisacvic</h3>
                        <p class="text-white text-lowercase mb-0">email</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="/assets/img/kit.jpg" alt="">
                    <div class="team-text w-100 position-absolute top-50 text-center dodajboju p-4">
                        <h3 class="text-white">Pavle Smakic</h3>
                        <p class="text-white text-lowercase mb-0">sp19034d@etf.bg.ac.rs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


<?= $this->endSection() ?>

