<?php namespace App\Models\Repositories;


/**
 * Description of KorisnikRepository
 *
 * @author andre
 */

use Doctrine\ORM\EntityRepository;
class KorisnikRepository extends EntityRepository{
    //put your code here
    
    public function login_DQL($korime){
        $dql = "SELECT k FROM App\Models\Entities\Korisnik k WHERE k.korime = :username";
        return $result = $this->getEntityManager()->createQuery($dql)
                ->setParameter('username', $korime)
                ->getResult();
    }
    
    public function user_double_DQL($korime){
        $dql = "SELECT k FROM App\Models\Entities\Korisnik k WHERE k.korime = :username";
        return $result = $this->getEntityManager()->createQuery($dql)
                ->setParameter('username', $korime)
                ->getResult();
    }
    
    public function email_double_DQL($mail){
        $dql = "SELECT k FROM App\Models\Entities\Korisnik k WHERE k.email = :mail";
        return $result = $this->getEntityManager()->createQuery($dql)
                ->setParameter('mail', $mail)
                ->getResult();
    }
    
    public function not_banned_users_DQL(){
        $dql = "SELECT k FROM App\Models\Entities\Korisnik k WHERE k.banovan = 0 AND k.role = :rola";
        return $result = $this->getEntityManager()->createQuery($dql)
                ->setParameter('rola', "korisnik")
                ->getResult();
    }
    
}
