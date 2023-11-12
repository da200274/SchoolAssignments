<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tip
 *
 * @ORM\Table(name="tip")
 * @ORM\Entity
 */
class Tip
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_tip", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTip;



    /**
     * Get idTip.
     *
     * @return int
     */
    public function getIdTip()
    {
        return $this->idTip;
    }
}
