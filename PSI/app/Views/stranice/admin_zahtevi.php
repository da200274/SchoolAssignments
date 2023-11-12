<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- @autor Marta Andjic 2020/0343 -->
<link href="/assets/css/admin.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function() {
        
        $(".zaht").click(function() {
            let t = $(this).attr('id');
            
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
            }
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("prikaz").innerHTML=xmlhttp.responseText; }
            } 
            xmlhttp.open("GET","<?= base_url() ?>/Admin/otvori_zahtev?q="+t,true); 
            xmlhttp.send();
            });
    }); 
    
</script>
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Admin</h1>
            </div>
        </div>
    </div>
    <!-- About Start -->
    <div class="container-fluid bg-secondary p-0">
        <div class="row g-0">
            
            <div class="col-lg-6 py-6 px-5 desnaivica">
                <h3 class="text-center">Requests to ban users:</h3>
                <?php foreach($res as $item) : ?>
                    <div class="mb-5 okvir bg-white">
                        <span class="zaht" id = "<?php echo $item->getIdZahtev()?>">
                        <?php echo $item->getIdUser()->getIme()." ".$item->getIdUser()->getPrezime()?></span>
                    </div>
                <?php endforeach; ?>
               
                <div class="row text-center">
                    <div class="col-12">
                        <a href="<?= site_url("Admin/admin")?>" class="">
                            <button class="btn btn mb-5 okvir text-white dodajboju">
                                Return
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="h-100 d-flex flex-column justify-content-center  p-5">
                    <div class="d-flex text-white mb-5">
                        <div class="container" id = "prikaz">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>