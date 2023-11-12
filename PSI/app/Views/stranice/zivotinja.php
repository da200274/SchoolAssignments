<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- @autor Pavle Smakic 2019/0347
        @autor Andreja Djokic 2020/0274
        @autor Marta Andjic 2020/0343
-->
<link href="<?php echo base_url(); ?>/assets/css/zivotinja.css" rel="stylesheet">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<?php
foreach ($slike as $slika) {
    if($slika->getPutanja()==$zivotinja->getNaslovnaSlika()){
        $front_picture = $slika;
        break;
    }
}
?>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function() {
        
        $("#lajk").click(function() {
            let odabir = $(".active.carousel-item").attr("id");
            
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
            }
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("lajkovi"+odabir).innerHTML=xmlhttp.responseText; }
            } 
            xmlhttp.open("GET","<?= base_url() ?>/Editor/od_lajkuj?slika="+odabir,true); 
            xmlhttp.send();
            });
    });
</script>

    <br>

    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center"><h2><?php echo $zivotinja->getNaziv()?></h2></div>
            <div class="col-4"></div>
        </div>
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 text-center">
                    <p class="text-dark"><?php echo $zivotinja->getOpis() ?></p>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row">
                <div class="mb-3 text-center">
                    <?php if ($role == 'korisnik'): ?>
                        <a href="<?php echo site_url('Editor/dodajtekst')?>">
                            <button class="zaokruzi btn btn-secondary">Change description</button>
                        </a>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">

                <div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" id="<?php echo $front_picture->getIdSlika()?>">
                            <img class="visina" style="width: 100%" src="<?php echo base_url() ?>assets/img/zivotinja/<?php echo $zivotinja->getNaslovnaSlika() ?>" alt="" >
                            <div id = "lajkovi<?php echo $front_picture->getIdSlika() ?>">
                                <?php
                                    echo "Likes: ".$front_picture->getBrojLajkova();
                                ?>
                            </div>
                            <div>
                                <?php
                                    echo "Comment: ".$slika->getKomentar();
                                ?>
                            </div>
                        </div>


                        <?php
                        foreach ($slike as $slika) {
                            if ($slika->getPutanja()!=$zivotinja->getNaslovnaSlika()) {
                                echo '<div class="carousel-item" id="' . $slika->getIdSlika() . '">
                                            <img  src="' . base_url() . 'assets/img/zivotinja/' . $slika->getPutanja() . '" class="d-block w-100 visina" style="width: 100%"  alt="...">
                                            <div id = "lajkovi'.$slika->getIdSlika().'">Likes: '.$slika->getBrojLajkova().'</div>
                                            <div>Comment: '.$slika->getKomentar().'</div>
                                       </div>';
                            }
                        }
                        ?>
                        
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            <br>
        </div>
        <?php if (isset($_SESSION['role']) && ($_SESSION['role']=='korisnik')) {
        echo "<div class='row'>
            <div class='col-10'></div>
            <div class='col-2'>
                <button id = 'lajk'>
                    <i class='fa fa-heart text-black'></i>
                </button>
            </div>
        </div>"; }
        ?>
        

        <br>

        <div class="mb-3 text-center">
            <?php if ($role == 'korisnik'): ?>
                <a href="<?php echo site_url('Editor/dodajsliku')?>"> <button class="zaokruzi btn btn-secondary">Add image</button></a>
            <?php endif; ?>
                    
        </div>


    </div>

<?= $this->endSection() ?>