<?php


namespace App\Models\Repositories;

/**
 * Description of SlikaRepository
 *
 * @author andre
 */
use Doctrine\ORM\EntityRepository;
class SlikaRepository extends EntityRepository {
    //put your code here
    public function pictures_animals($zivotinja){
        $dql = "SELECT s FROM App\Models\Entities\Slika s WHERE s.idZivotinja = :zivotinja";
        return $result = $this->getEntityManager()->createQuery($dql)
                ->setParameter('zivotinja', $zivotinja)
                ->getResult();
    }
}
