<!--

 Marta Andjic 2020/0343
  
 ZahtevModel - model za dohvatanje podataka o korisnickim zahtevima iz baze
  
 @version 1.0

 -->


<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="/assets/css/moderator.css">
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
            xmlhttp.open("GET","<?= base_url() ?>/Moderator/otvori_zahtev?q="+t,true); 
            xmlhttp.send();
            });
    }); 
    
</script>

    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Moderator</h1>
            </div>
        </div>
    </div>


<!-- About Start -->
    <div class="container-fluid bg-secondary p-0">
        <div class="row g-0">
            
            <div class="col-lg-6 py-6 px-5">
                <h3 class="text-center">User requests:</h3>
                
                <?php foreach ($res as $item) : ?>
                
                    <div class="mb-5 okvir bg-white">
                        <span class="zaht" id = "<?php echo $item['id_zahtev']?>">
                        <?php 
                        $req_type;
                        switch ($item['tip_zahteva']) {
                            case '1': $req_type = 'Add image';
                                        break;
                            case '2': $req_type = 'Edit caption';
                                        break;
                            case '3': $req_type = 'Add animal';
                                        break;
                            case '4': $req_type = 'Add area';
                                        break;
                            default : break;    
                        }
                        echo $item['ime']." ".$item['prezime']." - ".$req_type?>
                        <span id="boot-icon" class="bi bi-exclamation bg-primary float-right" style="font-size: 20px; color: rgb(255, 255, 255);"></span>
                        </span>
                    </div>
                
                <?php endforeach; ?>
                
                <div class="row text-center">
                    
                    <div class="col-12">
                        <a href="<?= site_url("Moderator/promeni_atrakciju")?>" >
                            <button class="btn btn mb-5 okvir text-white dodajboju">
                                Change animal of the day
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="h-100 d-flex flex-column justify-content-center  p-5">
                    <div class="d-flex text-white mb-5">
                        <div class="container bojateksta" id = "prikaz">
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>                
    <!-- About End -->
    

<?= $this->endSection() ?>

