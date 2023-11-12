<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

   <!-- @autor Pavle Smakic 2019/0347
        @autor Andreja Djokic 2020/0274
    -->

<link href="/assets/css/predeo.css" rel="stylesheet">
    
    <div class="container-fluid pt-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0"><?= $naziv ?></h1>
            <hr class="w-25 mx-auto bg-primary">
            <div>
                <?php if ($role == 'korisnik'): ?>
                    <a href="<?= site_url("Editor/dodaj_zivotinju") ?>" class="zaokruzi btn btn-secondary">Add animal to <?= $naziv ?></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <?php foreach ($list as $item) : ?>
                <div class="col-md-3">
                    <?php if ($role === 'gost'):  ?>
                    <div class="card" style="width: 17.6rem;">
                        <img class="card-img-top card-slike" src="/assets/img/zivotinja/<?php echo $item->getNaslovnaSlika(); ?>" alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $item->getNaziv(); ?></h4>
                            <a href="<?= site_url("Gost/zivotinja/{$item->getIdZivotinja()}")?>" class="zaokruzi btn btn-secondary">See Profile</a>
                        </div>
                    </div>
                    <?php elseif ($role == 'korisnik'): ?>
                    <div class="card" style="width: 17.6rem;">
                        <img class="card-img-top card-slike" src="/assets/img/zivotinja/<?php echo $item->getNaslovnaSlika(); ?>" alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $item->getNaziv(); ?></h4>
                            <a href="<?= site_url("Korisnik/zivotinja/{$item->getIdZivotinja()}")?>" class="zaokruzi btn btn-secondary">See Profile</a>
                        </div>
                    </div>
                    <?php elseif ($role == 'moderator'): ?>
                    <div class="card" style="width: 17.6rem;">
                        <img class="card-img-top card-slike" src="/assets/img/zivotinja/<?php echo $item->getNaslovnaSlika(); ?>" alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $item->getNaziv(); ?></h4>
                            <a href="<?= site_url("Moderator/zivotinja/{$item->getIdZivotinja()}")?>" class="zaokruzi btn btn-secondary">See Profile</a>
                        </div>
                    </div>
                    <?php elseif ($role == 'admin'): ?>
                    <div class="card" style="width: 17.6rem;">
                        <img class="card-img-top card-slike" src="/assets/img/zivotinja/<?php echo $item->getNaslovnaSlika(); ?>" alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $item->getNaziv(); ?></h4>
                            <a href="<?= site_url("Admin/zivotinja/{$item->getIdZivotinja()}")?>" class="zaokruzi btn btn-secondary">See Profile</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
        <?php endforeach; ?>
        </div>
    </div>
    <br>


<?= $this->endSection() ?>