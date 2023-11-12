<?php

namespace App\Models\Repositories;

/**
 * Description of LajkRepository
 *
 * @author andre
 */

use Doctrine\ORM\EntityRepository;
class LajkoviRepository extends EntityRepository {
    
    public function dohvati_lajk($id_user, $id_slika){
        $dql = "SELECT l FROM App\Models\Entities\Lajkovi l WHERE l.idUser = :idusr AND l.idSlika = :idslk";
        return $result = $this->getEntityManager()->createQuery($dql)
            ->setParameter('idusr', $id_user)
            ->setParameter('idslk', $id_slika)
            ->getResult();
    }
}
