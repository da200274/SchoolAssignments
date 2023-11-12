<?php

namespace App\Controllers;
use App\Models\ZahtevModel;

/**
 * Marta Andjic 2020/0343
 * 
 * Moderator - kontroler klasa u kojoj se nalaze sve metode usko vezane za moderatora
 * i odrzavanje sajta
 * 
 * @version 1.0
 */

class Moderator extends BaseController
{
    /**
     * Funkcija prikazi koja je deklarisana u zajednickom BaseControlleru
     * 
     * @param string $page - stranica koja treba da se prikaze
     * @param [] $data - niz potrebnih podataka za ucitavanje odgovarajucih stranica
     * @return type - poziv fje view koja prikazuje $page stranicu
     */
    protected function prikazi($page, $data){
        $data['role'] = $this->session->get('role');
        $data['controller'] = "Moderator";
        $data['meta_title'] = $page;
        return view("stranice/$page", $data);
    }
    
    public function about(){
        return BaseController::about();
    }
    
    public function index(){
        $data = BaseController::index();
        return $this->prikazi('index', $data);
    }
    
    public function zivotinja($param){
        $data = BaseController::zivotinja($param);
        return $this->prikazi('zivotinja', $data);
    }
    
    public function predeo($param){
        $data = BaseController::predeo($param);
        return $this->prikazi('predeo', $data);
    }
    public function moderator() {
        $db = db_connect();
        $sql = "SELECT ime, prezime, id_zahtev, tip_zahteva FROM korisnik k, zahtev z "
                . "WHERE status = 'pending' AND k.id_user IN "
                . "(SELECT id_user FROM zahtev WHERE z.id_zahtev = zahtev.id_zahtev)";
        $result = $db->query($sql)->getResultArray();
        return $this->prikazi('moderator', ['res'=>$result]);
    }
    
    
    public function otvori_zahtev(){
        $q = $_GET["q"];
        $this->session->set('otvoren_zahtev', $q);

        // get data
        $mod = new ZahtevModel();
        $red = $mod->dohvZahtev($q);

        echo "
                <div class='row slika'>
                    <div class='container'>
                        <div class='row text-center'>";
        
        $req_type;
        switch ($red['tip_zahteva']) {
            case '1': $req_type = 'Add image';
                    break;
            case '2': $req_type = 'Edit caption';
                    break;
            case '3': $req_type = 'Add animal';
                    break;
            case '4': $req_type = 'Add area';
                    break;
            }
        echo "<h4>$req_type</h4>
              <hr> </div></div></div><br>";

        if ($red['tip_zahteva'] == "4") {
        
            echo"
                <div class='container-fluid'>
                    <div class = 'row text-center'>
                        <img src = /assets/img/predeo/{$red['slika_predela']}>
                    </div>
                    <div class='row text-center text-dark'>
                        <div class='col-1'></div>
                        <div class='col-10'>
                            <div class='land_name'>Land name: {$red['naziv_predela']}</div>
                                <br>
                            <div class='request_description text-dark'>Land description: {$red['opis_predela']}</div>
                        </div>
                        <div class='col-1'></div>
                    </div>
                </div>
            <br><br>";
        }
        
        if ($red['tip_zahteva'] == "4" || $red['tip_zahteva'] == "3")  {
        
            echo "
                    <div class='container-fluid'>
                        <div class = 'row text-center'>
                            <img src =/assets/img/zivotinja/{$red['slika_zivotinje']}>
                        </div>
                        <div class='col-1'></div>
                        <div class='col-10'>
                            <div class='text-dark text-center request_description'>
                                Comment: {$red['komentar']}
                            </div>
                        </div>
                        <div class='col-1'></div><br>
                        <div class='row text-center text-dark'>
                            <div class='col-1'></div>
                            <div class='col-10'>
                                <div class='text-dark request_description'>Animal name and latin name: {$red['naziv_zivotinje']} ({$red['lat_naziv_zivotinje']})</div>
                                <div class='request_description text-dark'>Animal description: {$red['opis_zivotinje']}</div>
                            </div>
                            <div class='col-1'></div>
                        </div>
                    </div>
                ";
        }
        
        if ($red['tip_zahteva'] == "2") {
            
            $db = db_connect();
            $sql = "SELECT naziv FROM zivotinja WHERE id_zivotinja = ?";
            $rez = $db->query($sql, [$red['naziv_zivotinje']])->getRowArray();
            $naziv=$rez['naziv'];
            
            echo "
                    <div class='container-fluid'>
                        <div class = 'row text-center'> 
                        <p class='text-dark'> New caption for: $naziv </p>
                        </div>
                        <div class='row text-dark'>
                            <div class='col-1'></div>
                            <div class='col-10'>
                                <div class='request_description text-dark'>New description: {$red['opis_zivotinje']}</div>
                            </div>
                            <div class='col-1'></div>
                        </div>
                    </div>
                ";
        }
        
        if ($red['tip_zahteva'] == "1") {
            
            $db = db_connect();
            $sql = "SELECT naziv FROM zivotinja WHERE id_zivotinja = ?";
            $rez = $db->query($sql, [$red['naziv_zivotinje']])->getRowArray();
            $naziv=$rez['naziv'];
            
            echo "
                    <div class='container-fluid'>
                        <div class = 'row text-center '> 
                        <p class='text-dark'> New image of: $naziv </p>
                        </div>
                        <div class='row text-center'>
                            <img src = /assets/img/zivotinja/{$red['slika_zivotinje']}>
                            <div class='col-1'></div>
                            <div class='col-10'>
                                <div class='text-dark request_description'>
                                    Comment: {$red['komentar']}
                                </div>
                            </div>
                            <div class='col-1'></div>
                        </div>
                    </div>
                ";
        }
        
        $prihvati = site_url('Moderator/prihvati');
        $odbij = site_url('Moderator/odbij');
        $prijavi = site_url('Moderator/prijavi');
                            
        echo "<br><br><div class='row'></div>
                <div class='container'>
                    <div class='row opcije text-center'>
                        <div class='col-4'>
                            <form action = $prihvati>
                            <button class='btn btn-success full text-center'>ACCEPT</button>
                            </form>
                        </div>
                        <div class='col-4'>
                            <form action = $odbij>
                            <button class='btn btn-primary full text-center'>DENY</button>
                            </form>
                        </div>
                        <div class='col-4 text-center'>
                            <form action = $prijavi>
                            <button class='btn btn-warning full text-center'>REPORT</button>
                            </form>
                        </div>
                    </div>
                </div>";
    }
    
    public function prihvati() {
        $zahtev = $this->session->get('otvoren_zahtev');
        
        $db = db_connect();
        $sql = "SELECT tip_zahteva FROM zahtev where id_zahtev = ?";
        $tip = ($db->query($sql, [$zahtev])->getRow())->tip_zahteva;
        
        switch ($tip) {
            case '1' : return redirect()->to(site_url("Editor/prihvati_slika/$zahtev"));
            case '2' : return redirect()->to(site_url("Editor/prihvati_tekst/$zahtev"));
            case '3' : return redirect()->to(site_url("Editor/prihvati_zivotinja/$zahtev"));
            case '4' : return redirect()->to(site_url("Editor/prihvati_predeo/$zahtev"));
            default : break;
        }
    }
    
    public function odbij() {
        $zahtev = $this->session->get('otvoren_zahtev');
        
        $db = db_connect();
        $sql = "DELETE FROM zahtev WHERE id_zahtev = ?";
        $db->query($sql, [$zahtev]);
        
        return $this->moderator();
    }
    
    public function prijavi() {
        $zahtev = $this->session->get('otvoren_zahtev');
        
        $db = db_connect();
        $sql = "UPDATE zahtev SET status = 'reported' WHERE id_zahtev = ?";
        $db->query($sql, [$zahtev]);
        
        return $this->moderator();
    }
    
    public function promeni_atrakciju(){
        $db = db_connect();
        $sql = "SELECT * FROM zivotinja WHERE atrakcija = 1";
        $stara = $db->query($sql)->getResultArray();      
        
        if (count($stara) == 0) {
            $sql = "SELECT * FROM zivotinja";
            $nova = $db->query($sql)->getRowArray();
        }
        else {
            $sql = "SELECT * FROM zivotinja WHERE NOT atrakcija = 1";
            $niz = $db->query($sql)->getResultArray();
            $nova = $niz[rand(0, count($niz) - 1)];
        
            $sql = "UPDATE zivotinja SET atrakcija = 0 WHERE atrakcija = 1";
            $db->query($sql);
            
        }
        
        $sql = "UPDATE zivotinja SET atrakcija = 1 WHERE id_zivotinja = ?";
        $db->query($sql, [$nova['id_zivotinja']]);
        return $this->moderator();
    }
}
