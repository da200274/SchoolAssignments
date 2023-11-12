<?php

namespace App\Models\Repositories;

/**
 * Description of ZahtevRepository
 *
 * @author andre
 */

use Doctrine\ORM\EntityRepository;
class ZahtevRepository extends EntityRepository{
    //put your code here

    public function all_requests(){
        $dql = "SELECT z FROM App\Models\Entities\Zahtev z WHERE z.status = :status";
        return $result = $this->getEntityManager()->createQuery($dql)
                ->setParameter('status', 'reported')
                ->getResult();
    }
    
}
