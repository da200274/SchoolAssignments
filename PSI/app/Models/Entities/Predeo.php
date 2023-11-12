<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Predeo
 *
 * @ORM\Table(name="predeo")
 * @ORM\Entity(repositoryClass="App\Models\Repositories\PredeoRepository")
 */
class Predeo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_predeo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPredeo;

    /**
     * @var string
     *
     * @ORM\Column(name="naziv", type="string", length=45, nullable=false)
     */
    private $naziv;

    /**
     * @var string
     *
     * @ORM\Column(name="opis_predela", type="text", length=65535, nullable=false)
     */
    private $opisPredela;

    /**
     * @var string
     *
     * @ORM\Column(name="slika", type="string", length=255, nullable=false)
     */
    private $slika;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Zivotinja", mappedBy="idPredeo", orphanRemoval=true)
     */
    private $zivotinje = array();

    public function __construct() {
        $this->zivotinje = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idPredeo.
     *
     * @return int
     */
    public function getIdPredeo()
    {
        return $this->idPredeo;
    }

    /**
     * Set naziv.
     *
     * @param string $naziv
     *
     * @return Predeo
     */
    public function setNaziv($naziv)
    {
        $this->naziv = $naziv;

        return $this;
    }

    /**
     * Get naziv.
     *
     * @return string
     */
    public function getNaziv()
    {
        return $this->naziv;
    }

    /**
     * Set opisPredela.
     *
     * @param string $opisPredela
     *
     * @return Predeo
     */
    public function setOpisPredela($opisPredela)
    {
        $this->opisPredela = $opisPredela;

        return $this;
    }

    /**
     * Get opisPredela.
     *
     * @return string
     */
    public function getOpisPredela()
    {
        return $this->opisPredela;
    }

    /**
     * Set slika.
     *
     * @param string $slika
     *
     * @return Predeo
     */
    public function setSlika($slika)
    {
        $this->slika = $slika;

        return $this;
    }

    /**
     * Get slika.
     *
     * @return string
     */
    public function getSlika()
    {
        return $this->slika;
    }

    
    /**
     * Add zivotinje.
     *
     * @param \App\Models\Entities\Zivotinja $zivotinje
     *
     * @return Predeo
     */
    public function addZivotinje(\App\Models\Entities\Zivotinja $zivotinje)
    {
        if (!$this->zivotinje->contains($zivotinje)) {
            $this->zivotinje[] = $zivotinje;
            $zivotinje->setIdPredeo($this);
        }
        return $this;
    }

    /**
     * Remove zivotinje.
     *
     * @param \App\Models\Entities\Zivotinja $zivotinje
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeZivotinje(\App\Models\Entities\Zivotinja $zivotinje)
    {
        if($this->zivotinje->contains($zivotinje)){
            if($zivotinje->getIdPredeo() == $this){
                $zivotinje->setIdPredeo(null);
            }
            return $this->zivotinje->removeElement($zivotinje);
        }
        return false;
    }

    /**
     * Get zivotinje.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZivotinje()
    {
        return $this->zivotinje;
    }
}
