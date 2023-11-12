<?php

namespace App\Controllers;

/**
 * @autor Andreja Djokic 2020/0274
 * U ovoj klasi se nalaze sve fje koje su zajednicke za kontrolere
 */

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Entities;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form','url','html', 'array'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $this->session = \Config\Services::session();
        $this->doctrine=\Config\Services::doctrine();
    }

    protected function prikazi($page, $data) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    
    protected function index(){
        $result = $this->doctrine->em->getRepository(Entities\Predeo::class)->findAll();
        $data['land'] = $result;
        
        $atr = $this->doctrine->em->getRepository(Entities\Zivotinja::class)->animal_attraction();
        if (count($atr) == 0) {
            /*$sql = "SELECT * FROM zivotinja";
            $atr = $db->query($sql)->getRowArray();
            $sql = "UPDATE zivotinja SET atrakcija = 1 WHERE id_zivotinja = ?";
            $db->query($sql, [$atr['id_zivotinja']]);*/
        }
        else {
            $atr = $atr[0];
        }
        $data['atrakcija'] = $atr;
        return $data;
    }
    
    protected function about(){
        return $this->prikazi("about", []);
    }
    
    protected function predeo($param) {
        $land = $this->doctrine->em->getRepository(Entities\Predeo::class)->land_info($param);
        
        $this->session->set('idpredela',$param);
        $data['list'] = $land[0]->getZivotinje();
        $data['naziv'] = $land[0]->getNaziv();
        return $data;
    }
    
    protected function zivotinja($param) {
        $animal = $this->doctrine->em->getRepository(Entities\Zivotinja::class)->animal_info($param);
        
        $this->session->set('idzivotinje', $param);
        $data['slike'] = $animal[0]->getSlike();
        $data['zivotinja'] = $animal[0];
        return $data;
    }
    
    /**
     * Funkcija koja dovlaci iz baze podatke relevantne za korisnika i prikazuje ih
     * 
     */
    protected function profile() {
        $korisnik = $this->doctrine->em->getRepository(Entities\Korisnik::class)->find($this->session->get('id'));
        $data = $this->extract_profile_info($korisnik);
        return $data;
    }
}
