<?php
/**
 * @autor Andreja Djokic 2020/0274
 * 
 * Gost - klasa koja sadrzi sve funkcije relevantne za neulogovane posetioce sajta
 * 
 * @version 1.1
 */

namespace App\Controllers;
use App\Models\Entities;

class Gost extends BaseController
{
    protected function prikazi($page, $data){
        $data['role'] = "gost";
        $data['meta_title'] = $page;
        return view("stranice/$page", $data);
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
    
    public function about(){
        return BaseController::about();
    }
    
    public function login($poruka = null) {
        return $this->prikazi("login", ['poruka' => $poruka]);
    }
    
    public function register($poruka = null){
        return $this->prikazi("register", ['poruka' => $poruka]);
    }
    
    public function login_check() {
        if(!$this->validate(['username'=>'required', 'password'=>'required'])){
            return $this->prikazi('login', ['errors'=>$this->validator->getErrors()]);
        }
        
        $korime = $this->request->getVar('username');
        $lozinka = $this->request->getVar('password');
        
        $korisnici = $this->doctrine->em->getRepository(Entities\Korisnik::class)
                ->login_DQL($korime, $lozinka);
        if(count($korisnici) == 1){
            $korisnik = $korisnici[0];
            if(password_verify($lozinka, $korisnik->getLozinka())){
                return $this->login('Wrong password');
            }
            $id = $korisnik->getIdUser();
            $tip = $korisnik->getRole();
            
            if($tip == 'korisnik' && $korisnik->getBanovan() == '1'){
                return $this->login('User banned');
            }
            
            $this->session->set('role', $tip);
            $this->session->set('korime', $korime);
            $this->session->set('id', $id);
            if($tip == 'korisnik')return redirect()->to(site_url('Korisnik'));
            else if($tip == 'moderator') return redirect()->to(site_url('Moderator'));
            else if($tip == 'admin') return redirect()->to(site_url('Admin'));
            
        }else if(count($korisnici) == 0){
            return $this->login('User non existent');
        }
    }
    
    public function register_check(){
        if(!$this->validate([
            'korime'=>'required|min_length[5]',
            'password_'=>'required|min_length[5]',
            'name' => 'required',
            'surname' => 'required',
            'country' => 'required',
            'email' => 'required',
            'repeat_password' => 'required'])){
            return $this->prikazi('register', ['errors'=>$this->validator->getErrors()]);
        }
        $korime = $this->request->getVar('korime');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password_');
        $password_repeat = $this->request->getVar('repeat_password');
        
        
        if(!preg_match( "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/",$email)){
            return $this->register('Invalid email format given.');
        }
        else if(!preg_match('/^[A-Za-z0-9]+$/', $korime)){
            return $this->register('Only digits and letters allowed for username.');
        }else if($password != $password_repeat){
            return $this->register('Both passwords should match.') ;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $korisnici = $this->doctrine->em->getRepository(Entities\Korisnik::class)
                ->user_double_DQL($korime);
        if(count($korisnici)){
            return $this->register('This username has been taken, try another one.') ;
        }
        
        $emails = $this->doctrine->em->getRepository(Entities\Korisnik::class)
                ->email_double_DQL($email);
        if(count($emails)){
            var_dump($emails);
            return $this->register('This email has been taken, try another one.') ;
        }
        
        $korisnik = new Entities\Korisnik();
        $korisnik->setIme($this->request->getVar('name'));
        $korisnik->setPrezime($this->request->getVar('surname'));
        $korisnik->setDrzava($this->request->getVar('country'));
        
        $korisnik->setKorime($korime);
        $korisnik->setLozinka($hashedPassword);
        $korisnik->setEmail($email);
        
        $korisnik->setBanovan('0');
        $korisnik->setRole('korisnik');
        
        $this->doctrine->em->persist($korisnik);
        $this->doctrine->em->flush();
        
        return redirect()->to(site_url('Gost/login'));
    }
}
