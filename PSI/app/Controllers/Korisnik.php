<?php

namespace App\Controllers;
use CodeIgniter\Files\File;
use App\Models\ZahtevModel;

/**
 * @autor Andreja Djokic 2020/0274
 * Pavle Smakic 2019/0347
 * 
 * Korisnik - kontroler klasa u kojoj se nalaze sve metode usko vezane za korisnike
 * 
 * @version 1.1
 */

class Korisnik extends BaseController
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
        $data['controller'] = "Korisnik";
        $data['meta_title'] = $page;
        return view("stranice/$page", $data);
    }
    
    public function about(){
        return BaseController::about();
    }

    public function profile() {
        $data = BaseController::profile();
        return $this->prikazi('profile', $data);
    }
    
    public function zivotinja($param){
        $data = BaseController::zivotinja($param);
        return $this->prikazi('zivotinja', $data);
    }
    
    public function predeo($param){
        $data = BaseController::predeo($param);
        return $this->prikazi('predeo', $data);
    }
    
    public function index(){
        $data = BaseController::index();
        return $this->prikazi('index', $data);
    }

    /**
     * Funkcija koja radi odjavljivanje korisnika sa sajta
     * 
     */
    public function log_out(){
        $this->session->destroy();
        return redirect()->to(site_url('Gost'));
    }
    
    /**
     * 
     * @param QueryResult $korisnik - red iz db koji sadrzi sve relevantne info o korisniku io radi njihovo ekstrahovanje
     * @return [] $data - niz sa podacima potrebnim za prikaz na stranici profile
     */
    public function extract_profile_info($korisnik){
       $data = [
            'name' => $korisnik->getIme(),
            'surname' => $korisnik->getPrezime(),
            'username' => $korisnik->getKorime(),
            'country' => $korisnik->getDrzava(),
            'email' => $korisnik->getEmail(),
            'role' => $korisnik->getRole()
        ];
        return $data;
    }
    
    public function dodajpredeo(){
        return $this->prikaz('dodajpredeo',[]);
    }
    public function dodajzivotinju(){
        return $this->prikaz('dodajzivotinju',[]);
    }



    public function posaljizahtevzivotinja()
    {

        if(!$this->validate([
            'zime'=>'required|min_length[1]',
            'zlime'=>'required|min_length[1]',
            'zopis'=>'required|min_length[50]',
            'zimg' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[zimg]',
                    'is_image[zimg]',
                    'mime_in[zimg,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[zimg,9999999]',
                    'max_dims[zimg,1024,768]',
                ],
            ],
        ])){
            return $this->prikaz('dodajzivotinju',
                ['errors'=>$this->validator->listErrors()]);
        }


        $zah=new ZahtevModel();

        $session=session();
        $item = $session->get('kor');


        $zah->save([
            'znaziv'=>$this->request->getVar('zime'),
            'zlnaziv'=>$this->request->getVar('zlime'),
            'zopis'=>$this->request->getVar('zopis'),
            'kor'=>$item->id
        ]);
        return redirect()->to(site_url('Korisnik'));
    }


}
