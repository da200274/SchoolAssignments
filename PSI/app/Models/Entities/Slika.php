<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Slika
 *
 * @ORM\Table(name="slika", indexes={@ORM\Index(name="slika_ibfk_1", columns={"id_zivotinja"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\SlikaRepository")
 */
class Slika
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_slika", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSlika;

    /**
     * @var string
     *
     * @ORM\Column(name="komentar", type="text", length=65535, nullable=false)
     */
    private $komentar;

    /**
     * @var string
     *
     * @ORM\Column(name="putanja", type="string", length=45, nullable=false)
     */
    private $putanja;

    /**
     * @var int
     *
     * @ORM\Column(name="broj_lajkova", type="integer", nullable=false)
     */
    private $brojLajkova;

    /**
     * @var \App\Models\Entities\Zivotinja
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Zivotinja")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_zivotinja", referencedColumnName="id_zivotinja")
     * })
     */
    private $idZivotinja;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Lajkovi", mappedBy="idSlika", orphanRemoval=true)
     */
    private $lajkovi = array();

    public function __construct() {
        $this->lajkovi = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idSlika.
     *
     * @return int
     */
    public function getIdSlika()
    {
        return $this->idSlika;
    }

    /**
     * Set komentar.
     *
     * @param string $komentar
     *
     * @return Slika
     */
    public function setKomentar($komentar)
    {
        $this->komentar = $komentar;

        return $this;
    }

    /**
     * Get komentar.
     *
     * @return string
     */
    public function getKomentar()
    {
        return $this->komentar;
    }

    /**
     * Set putanja.
     *
     * @param string $putanja
     *
     * @return Slika
     */
    public function setPutanja($putanja)
    {
        $this->putanja = $putanja;

        return $this;
    }

    /**
     * Get putanja.
     *
     * @return string
     */
    public function getPutanja()
    {
        return $this->putanja;
    }

    /**
     * Set brojLajkova.
     *
     * @param int $brojLajkova
     *
     * @return Slika
     */
    public function setBrojLajkova($brojLajkova)
    {
        $this->brojLajkova = $brojLajkova;

        return $this;
    }

    /**
     * Get brojLajkova.
     *
     * @return int
     */
    public function getBrojLajkova()
    {
        return $this->brojLajkova;
    }

    /**
     * Set idZivotinja.
     *
     * @param \App\Models\Entities\Zivotinja|null $idZivotinja
     *
     * @return Slika
     */
    public function setIdZivotinja(\App\Models\Entities\Zivotinja $idZivotinja = null)
    {
        $this->idZivotinja = $idZivotinja;

        return $this;
    }

    /**
     * Get idZivotinja.
     *
     * @return \App\Models\Entities\Zivotinja|null
     */
    public function getIdZivotinja()
    {
        return $this->idZivotinja;
    }

    /**
     * Add lajkovi.
     *
     * @param \App\Models\Entities\Lajkovi $lajkovi
     *
     * @return Slika
     */

    /**
     * Add lajkovi.
     *
     * @param \App\Models\Entities\Lajkovi $lajkovi
     *
     * @return Slika
     */
    public function addLajkovi(\App\Models\Entities\Lajkovi $lajkovi)
    {
        if (!$this->lajkovi->contains($lajkovi)) {
            $this->lajkovi[] = $lajkovi;
            $lajkovi->setIdSlika($this);
        }
        return $this;
    }

    /**
     * Remove lajkovi.
     *
     * @param \App\Models\Entities\Lajkovi $lajkovi
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLajkovi(\App\Models\Entities\Lajkovi $lajkovi)
    {
        if($this->lajkovi->contains($lajkovi)){
            if($lajkovi->getIdSlika() == $this){
                $lajkovi->setIdSlika(null);
            }
            return $this->lajkovi->removeElement($lajkovi);
        }
        return false;
    }

    /**
     * Get lajkovi.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLajkovi()
    {
        return $this->lajkovi;
    }
}
