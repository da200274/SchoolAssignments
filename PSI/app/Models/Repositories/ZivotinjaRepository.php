<?php 


namespace App\Models\Repositories;

/**
 * Description of ZivotinjaRepository
 *
 * @author andre
 */

use Doctrine\ORM\EntityRepository;
class ZivotinjaRepository extends EntityRepository{
    //put your code here
    
    public function all_animals_land($predeo){
        $dql = "SELECT a FROM App\Models\Entities\Zivotinja a WHERE a.idPredeo = :predeo";
        return $result = $this->getEntityManager()->createQuery($dql)
                ->setParameter('predeo', $predeo)
                ->getResult();
    }
    
    public function animal_info($animal){
        $dql = "SELECT a FROM App\Models\Entities\Zivotinja a WHERE a.idZivotinja = :zivotinja";
        return $result = $this->getEntityManager()->createQuery($dql)
                ->setParameter('zivotinja', $animal)
                ->getResult();
    }
    
    public function animal_attraction(){
        $dql = "SELECT a FROM  App\Models\Entities\Zivotinja a WHERE a.atrakcija = 1";
        return $result = $this->getEntityManager()->createQuery($dql)
                ->getResult();
    }
}
