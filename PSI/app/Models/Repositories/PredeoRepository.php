<?php

namespace App\Models\Repositories;

/**
 * Description of PredeoRepository
 *
 * @author andre
 */
use Doctrine\ORM\EntityRepository;
class PredeoRepository extends EntityRepository{
    //put your code here
    public function land_info($predeo){
        $dql = "SELECT p FROM App\Models\Entities\Predeo p WHERE p.idPredeo = :predeo";
        return $result = $this->getEntityManager()->createQuery($dql)
                ->setParameter('predeo', $predeo)
                ->getResult();
    }
}
