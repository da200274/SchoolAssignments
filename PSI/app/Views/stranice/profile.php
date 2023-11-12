<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link href="/assets/css/profile.css" rel="stylesheet">
    <!-- @autor Pavle Smakic 2019/0347
        @autor Andreja Djokic 2020/0274
    -->
<!-- About Start -->
<div class="container-fluid bg-secondary p-0 pozadina">
    <br>
    <div class="row text-center">
        <h2>Info about user</h2>
    </div>
    <div class="row g-0">
        <div class="col-lg-4">
            <div class="container">
                <div class="row left text-center">
                    <div class="col-2">
                        
                    </div>
                    <div class="col-3">

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="h-100 d-flex flex-column justify-content-center  p-5">
                <div class="d-flex text-white mb-5">
                    <div class="container">
                        <div class="row">
                            <div class="container">
                                
                                <div class="row left text-center">
                                    <div class="col-2"><p class="bojateksta">Name:</p></div>
                                    <div class="col-3">
                                        <?php if(isset($name)) echo "<h5>$name</h5><br>"; ?>
                                    </div>
                                </div>
                                
                                <div class="row text-center">
                                    <div class="col-2"><p class="bojateksta">Surname:</p></div>
                                     <div class="col-3">
                                        <?php if(isset($surname)) echo "<h5>$surname</h5><br>"; ?>
                                    </div>
                                </div>
                                
                                <div class="row text-center">
                                    <div class="col-2"><p class="bojateksta">Username:</p></div>
                                     <div class="col-3">
                                        <?php if(isset($username)) echo "<h5>$username</h5><br>"; ?>
                                    </div>
                                </div>
                                
                                <div class="row text-center">
                                    <div class="col-2"><p class="bojateksta">Email:</p></div>
                                     <div class="col-3">
                                        <?php if(isset($email)) echo "<h5>$email</h5><br>"; ?>
                                    </div>
                                </div>
                                
                                <div class="row text-center">
                                    <div class="col-2"><p class="bojateksta">Country:</p></div>
                                     <div class="col-3">
                                        <?php if(isset($country)) echo "<h5>$country</h5><br>"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>


<?= $this->endSection() ?>

