<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use App\Models\ZahtevModel;
use App\Models\LajkModel;

class Editor extends BaseController{
    protected function prikazi($page, $data){
        $data['role'] = $this->session->get('role');
        $data['controller'] = "Korisnik";
        $data['meta_title'] = $page;
        return view("stranice/$page", $data);
    }

    public function dodajsliku()
    {
        if(!isset($_SESSION['role'])){
            return redirect()->to(site_url('Gost/login'));
        }
        return $this->prikazi('dodajsliku', []);
    }
    
    public function dodajtekst()
    {
        if(!isset($_SESSION['role'])){
            return redirect()->to(site_url('Gost/login'));
        }
        return $this->prikazi('dodajtekst', []);
    }

    public function dodaj_predeo()
    {
        if(!isset($_SESSION['role'])){
            return redirect()->to(site_url('Gost/login'));
        }

        return $this->prikazi('dodaj_predeo', []);
    }

    public function dodaj_zivotinju()
    {
        if(!isset($_SESSION['role'])){
            return redirect()->to(site_url('Gost/login'));
        }
        return $this->prikazi('dodaj_zivotinju', []);
    }



    public function posaljizahtevzivotinja()
    {
        if (!$this->validate([
            'zime' => 'required|min_length[1]',
            'zlime' => 'required|min_length[1]',
            'zopis' => 'required|min_length[50]',
            'zkom'=> 'required|min_length[20]',
            'zimg' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[zimg]',
                    'is_image[zimg]',
                    'mime_in[zimg,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[zimg,1000000]',
                    'max_dims[zimg,1024000,768000]',
                ],
            ],
        ])) {
            return $this->prikazi('dodaj_zivotinju',
                ['errors' => $this->validator->listErrors()]);
        }

        $img = $this->request->getFile('zimg');

        $zah = new ZahtevModel();

        $newname = 'z' . $this->session->get('id') . $img->getClientName();
        $img->move('../public/assets/img/zivotinja', $newname);


        $zah->save([
            'naziv_predela' => $this->session->get('idpredela'),
            'naziv_zivotinje' => $this->request->getVar('zime'),
            'lat_naziv_zivotinje' => $this->request->getVar('zlime'),
            'opis_zivotinje' => $this->request->getVar('zopis'),
            'komentar'=>$this->request->getVar('zkom'),
            'slika_zivotinje' => $newname,
            'id_user' => $this->session->get('id'),
            'tip_zahteva' => 3,
            'status' => 'pending'
        ]);

        return redirect()->to(site_url('Korisnik'));
    }

    public function posaljizahtevpredeo()
    {
        if (!$this->validate([
            'pime' => 'required|min_length[1]',
            'popis' => 'required|min_length[50]',
            'zime' => 'required|min_length[1]',
            'zlime' => 'required|min_length[1]',
            'zopis' => 'required|min_length[50]',
            'zkom'=> 'required|min_length[20]',
            'zimg' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[zimg]',
                    'is_image[zimg]',
                    'mime_in[zimg,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[zimg,1000000]',
                    'max_dims[zimg,1024000,768000]',
                ],
            ],
            'pimg' => [
                'label' => 'Image File P',
                'rules' => [
                    'uploaded[pimg]',
                    'is_image[pimg]',
                    'mime_in[pimg,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[pimg,1000000]',
                    'max_dims[pimg,1024000,768000]',
                ],
            ],
        ])) {
            return $this->prikazi('dodaj_predeo',
                ['errors' => $this->validator->listErrors()]);
        }

        $img = $this->request->getFile('zimg');
        $pimg = $this->request->getFile('pimg');
        $zah = new ZahtevModel();

        $newname = 'z' . $this->session->get('id') . $img->getClientName();
        $pnewname = 'p' . $this->session->get('id') . $pimg->getClientName();
        $img->move('../public/assets/img/zivotinja', $newname);
        $pimg->move('../public/assets/img/predeo', $pnewname);

        $zah->save([
            'naziv_predela' => $this->request->getVar('pime'),
            'opis_predela' => $this->request->getVar('popis'),
            'naziv_zivotinje' => $this->request->getVar('zime'),
            'lat_naziv_zivotinje' => $this->request->getVar('zlime'),
            'opis_zivotinje' => $this->request->getVar('zopis'),
            'komentar'=>$this->request->getVar('zkom'),
            'slika_zivotinje' => $newname,
            'slika_predela' => $pnewname,
            'id_user' => $this->session->get('id'),
            'tip_zahteva' => 4,
            'status' => 'pending'
        ]);

        return redirect()->to(site_url('Korisnik'));
    }

    public function posaljizahtevslika(){
        if (!$this->validate([
            'zkom'=> 'required|min_length[20]',
            'zimg' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[zimg]',
                    'is_image[zimg]',
                    'mime_in[zimg,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[zimg,1000000]',
                    'max_dims[zimg,1024000,768000]',
                ],
            ]
        ])) {
            return $this->prikazi('dodajsliku',
                ['errors' => $this->validator->listErrors()]);
        }
        $img = $this->request->getFile('zimg');

        $zah = new ZahtevModel();

        $session = session();

        $rola= $session->get('role');
        $newname = 'z' . $this->session->get('id') . $img->getClientName();
        $img->move('../public/assets/img/zivotinja', $newname);
        $zah->save([
            'naziv_zivotinje'=> $this->session->get('idzivotinje'),//Ovde se cuva ID zivotinje koja treba da se prosledi u session kako bi se postavio odgovarajuci id zivotinje u tabeli slika
            'slika_zivotinje' => $newname,
            'komentar'=>$this->request->getVar('zkom'),
            'id_user' => $this->session->get('id'),
            'tip_zahteva' =>1,
            'status' => 'pending'
        ]);

        return redirect()->to(site_url('Korisnik'));
    }

    public function posaljizahtevtekst(){
        if (!$this->validate([
            'zopis' => 'required|min_length[50]'
        ])) {
            return $this->prikazi('dodajtekst',
                ['errors' => $this->validator->listErrors()]);
        }
        $zah = new ZahtevModel();
        $session = session();

        $zah->save([
            'naziv_zivotinje'=> $this->session->get('idzivotinje'),//Ovde se cuva ID zivotinje koja treba da se prosledi u session kako bi se postavio odgovarajuci id zivotinje u tabeli slika
            'opis_zivotinje'=> $this->request->getVar('zopis'),
            'id_user' => $this->session->get('id'),
            'tip_zahteva' => 2,
            'status' => 'pending'
        ]);
        return redirect()->to(site_url('Korisnik'));
    }
    
    /*
     * Marta Andjic 2020/0343
     * 
     * funkcionalnosti za odrzavanje sajta kroz moderatora
     */
    
    public function prihvati_slika($zahtev) {
        $db = db_connect();
        $sql = "SELECT * FROM zahtev WHERE id_zahtev = ?";
        $res = $db->query($sql, [$zahtev])->getRowArray();
        
        $zivotinja = $res['naziv_zivotinje'];                 //ovde je potrebno da se upise id predela pri slanju zahteva
        $zslika = $res['slika_zivotinje'];
        $kom = $res['komentar'];
        
        $sql = "INSERT INTO slika(id_zivotinja, komentar, putanja, broj_lajkova) VALUES (?, ?, ?, ?)";
        $db->query($sql, [$zivotinja, $kom, $zslika, 0]);
        $sql = "DELETE FROM zahtev WHERE id_zahtev = ?";
        $db->query($sql, [$zahtev]);
        
        return redirect()->to(site_url('Moderator/moderator'));
    }
    
    public function prihvati_tekst($zahtev) {
        $db = db_connect();
        $sql = "SELECT * FROM zahtev WHERE id_zahtev = ?";
        $res = $db->query($sql, [$zahtev])->getRowArray();
        
        $zivotinja = $res['naziv_zivotinje'];
        $novi_opis = $res['opis_zivotinje'];
        
        $sql = "SELECT opis FROM zivotinja WHERE id_zivotinja = ?";
        $stari_opis = ($db->query($sql, [$zivotinja])->getRow())->opis;
        
        $sql = "UPDATE zivotinja SET opis = ? WHERE id_zivotinja = ?";
        $db->query($sql, [$stari_opis." ".$novi_opis, $zivotinja]);
        $sql = "DELETE FROM zahtev WHERE id_zahtev = ?";
        $db->query($sql, [$zahtev]);
        
        return redirect()->to(site_url('Moderator/moderator'));
    }
    
    public function prihvati_zivotinja($zahtev) {
        $db = db_connect();
        $sql = "SELECT * FROM zahtev WHERE id_zahtev = ?";
        $res = $db->query($sql, [$zahtev])->getRowArray();
        
        $predeo = $res['naziv_predela'];                      //ovde je potrebno da se upise id predela pri slanju zahteva
        $znaziv = $res['naziv_zivotinje'];
        $lnaziv = $res['lat_naziv_zivotinje'];
        $zopis = $res['opis_zivotinje'];
        $zslika = $res['slika_zivotinje'];
        $kom = $res['komentar'];
        
        $sql = "INSERT INTO zivotinja(id_predeo, naziv, latinski_naziv,"
                . " naslovna_slika, opis) VALUES (?, ?, ?, ?, ?)";
        $db->query($sql, [$predeo, $znaziv, $lnaziv, $zslika, $zopis]);
        $zivotinja = $db->insertID();
        $sql = "INSERT INTO slika(id_zivotinja, komentar, putanja, broj_lajkova) VALUES (?, ?, ?, ?)";
        $db->query($sql, [$zivotinja, $kom, $zslika, 0]);
        $sql = "DELETE FROM zahtev WHERE id_zahtev = ?";
        $db->query($sql, [$zahtev]);
        
        return redirect()->to(site_url('Moderator/moderator'));
    }
    
    public function prihvati_predeo($zahtev) {
        $db = db_connect();
        $sql = "SELECT * FROM zahtev WHERE id_zahtev = ?";
        $res = $db->query($sql, [$zahtev])->getRowArray();
        
        $pnaziv = $res['naziv_predela'];
        $popis = $res['opis_predela'];
        $pslika = $res['slika_predela'];
        $znaziv = $res['naziv_zivotinje'];
        $lnaziv = $res['lat_naziv_zivotinje'];
        $zopis = $res['opis_zivotinje'];
        $zslika = $res['slika_zivotinje'];
        $kom = $res['komentar'];
        
        $sql = "INSERT INTO predeo(naziv, opis_predela, slika) VALUES (?, ?, ?)";
        $db->query($sql, [$pnaziv, $popis, $pslika]);
        $predeo = $db->insertID();
        $sql = "INSERT INTO zivotinja(id_predeo, naziv, latinski_naziv,"
                . " naslovna_slika, opis) VALUES (?, ?, ?, ?, ?)";
        $db->query($sql, [$predeo, $znaziv, $lnaziv, $zslika, $zopis]);
        $zivotinja = $db->insertID();
        $sql = "INSERT INTO slika(id_zivotinja, komentar, putanja, broj_lajkova) VALUES (?, ?, ?, ?)";
        $db->query($sql, [$zivotinja, $kom, $zslika, 0]);
        $sql = "DELETE FROM zahtev WHERE id_zahtev = ?";
        $db->query($sql, [$zahtev]);
        
        return redirect()->to(site_url('Moderator/moderator'));
    }
    
    /*
     * Marta Andjic 2020/0343
     * 
     * funkcija za lajkovanje slika zivotinja
     */

    public function od_lajkuj() {
        $idusr = $this->session->id;
        $slika = $_GET['slika'];

         $model = new LajkModel();
         $nr = $model->pritisnuto($idusr, $slika);

         echo "Likes: ".$nr;
    }

}