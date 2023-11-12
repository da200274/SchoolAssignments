<?php

namespace App\Controllers;
use App\Models\Entities;

/**
 * Andreja Djokic 2020/0274
 * Marta Andjic 2020/0343
 * Admin - klasa koja se koristi kada imamo specijalnme zahteve upucene od strane admina
 * 
 * @version 1.0
 */
class Admin extends BaseController
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
        $data['controller'] = "Admin";
        $data['meta_title'] = $page;
        return view("stranice/$page", $data);
    }
    
    public function index(){
        $data = BaseController::index();
        return $this->prikazi('index', $data);
    }
    
    public function about(){
        return BaseController::about();
    }
    
    public function zivotinja($param){
        $data = BaseController::zivotinja($param);
        return $this->prikazi('zivotinja', $data);
    }
    
    public function predeo($param){
        $data = BaseController::predeo($param);
        return $this->prikazi('predeo', $data);
    }
    
    /**
     * Funkcija za prikaz inboks stranice admina u kom se nalaze svi korisnici, porudzbine, zahtevi za banovanjem
     * @return type
     */
    public function admin(){
        $result = $this->doctrine->em->getRepository(Entities\Korisnik::class)->not_banned_users_DQL();
        return $this->prikazi('admin_index', ['res'=>$result]);
    }
    
    
    /**
     * Funkcija koja prikazuje sve zahteve upucene od strane moderatora adminu
     * @return type
     */
    public function zahtevi(){
        $result = $this->doctrine->em->getRepository(Entities\Zahtev::class)->all_requests();
        return $this->prikazi('admin_zahtevi', ['res'=>$result]);
    }
    
    public function otvori_zahtev(){
        $q = $_GET["q"];
        $this->session->set('otvoren_zahtev', $q);
        $zahtev = $this->doctrine->em->getRepository(Entities\Zahtev::class)->find($q);
        $korisnik = $this->doctrine->em->getRepository(Entities\Korisnik::class)->find($zahtev->getIdUser());
        
        
        
        $prihvati = site_url('Admin/prihvati');
        $odbij = site_url('Admin/odbij');
        
        echo "<div class='row slika'>
                <div class='container'>
                    <div class='row text-left'>
                        <div class='col-4'></div>
                        <div class='col-3'><p class='bojateksta'>Username:</p></div>
                        <div class='col-3'><h5>{$korisnik->getKorime()}</h5></div>
                    </div>
                    <div class='row text-left'>
                        <div class='col-4'></div>
                        <div class='col-3'><p class='bojateksta'>Email:</p></div>
                        <div class='col-3'><h5>{$korisnik->getEmail()}</h5></div>
                    </div>
                </div>
            </div>
            <div class='row'></div>
                <div class='container'>
                    <div class='row opcije text-center'>
                        <div class='col-1'></div>
                        <div class='col-4'>
                            <form action = $odbij>
                            <button class='btn btn-warning full text-center'>DO NOT BAN</button></div>
                            </form>
                        <div class='col-2'></div>
                        <div class='col-4 text-center'>
                            <form action = $prihvati>
                            <button class='btn btn-primary full text-center'>BAN USER</button></div>
                            </form>
                    </div></div> ";
    }
    
    public function prihvati() {
        $zahtev = $this->session->get('otvoren_zahtev');
        
        $current = $this->doctrine->em->getRepository(Entities\Zahtev::class)->find($zahtev);
        $userId = $current->getIdUser();
        $userId->setBanovan('1');
        
        if($current){
            $this->doctrine->em->remove($current);
        }
        $this->doctrine->em->flush();
        
        return $this->zahtevi();
    }
    
    public function odbij() {
        $zahtev = $this->session->get('otvoren_zahtev');
        $current = $this->doctrine->em->getRepository(Entities\Zahtev::class)->find($zahtev);
        if($current){
            $this->doctrine->em->remove($current);
        }
        $this->doctrine->em->flush();
        
        return $this->zahtevi();
    }
    
    public function otvori_profil() {
        $q = $_GET["q"];
        $korisnik = $this->doctrine->em->getRepository(Entities\Korisnik::class)->find($q);
        
        echo "<div class='row text-center'>
                <div class='col-4'></div>
                <div class='col-4'><p class='bojateksta'><h4>User data</h4></p></div>
                <div class='col-4'><h5></h5></div></div>
            <div class='row text-center'>
                <div class='col-4'></div>
                <div class='col-2'><p class='bojateksta'>Name:</p></div>
                <div class='col-3'><h5>{$korisnik->getIme()}</h5></div></div>
            <div class='row text-center'>
                <div class='col-4'></div>
                <div class='col-2'><p class='bojateksta'>Surname:</p></div>
                <div class='col-3'><h5>{$korisnik->getPrezime()}</h5></div></div>
            <div class='row text-center'>
                <div class='col-4'></div>
                <div class='col-2'><p class='bojateksta'>Username:</p></div>
                <div class='col-3'><h5>{$korisnik->getKorime()}</h5></div></div>
            <div class='row text-center'>
                <div class='col-4'></div>
                <div class='col-2'><p class='bojateksta'>Email:</p></div>
                <div class='col-3'><h5>{$korisnik->getEmail()}</h5></div></div>
            <div class='row text-center'>
                <div class='col-4'></div>
                <div class='col-2'><p class='bojateksta'>Country:</p></div>
                <div class='col-3'><h5>{$korisnik->getDrzava()}</h5></div></div>
            <div class='row text-center'>
                <div class='col-4'></div>
                <div class='col-2'><p class='bojateksta'>Password</p></div>
                <div class='col-3'><h5>********</h5></div>
                <div class='col-1'><i class='fa fa-eye-slash bojateksta' aria-hidden='true'></i></div></div>";
    }
}
