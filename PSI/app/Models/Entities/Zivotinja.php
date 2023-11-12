<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zivotinja
 *
 * @ORM\Table(name="zivotinja", indexes={@ORM\Index(name="zivotinja_ibfk_1", columns={"id_predeo"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\ZivotinjaRepository")
 */
class Zivotinja
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_zivotinja", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idZivotinja;

    /**
     * @var string
     *
     * @ORM\Column(name="naziv", type="string", length=45, nullable=false)
     */
    private $naziv;

    /**
     * @var string
     *
     * @ORM\Column(name="latinski_naziv", type="string", length=45, nullable=false)
     */
    private $latinskiNaziv;

    /**
     * @var string
     *
     * @ORM\Column(name="naslovna_slika", type="string", length=45, nullable=false)
     */
    private $naslovnaSlika;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="text", length=65535, nullable=false)
     */
    private $opis;

    /**
     * @var bool
     *
     * @ORM\Column(name="atrakcija", type="boolean", nullable=false)
     */
    private $atrakcija = '0';

    /**
     * @var \App\Models\Entities\Predeo
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Predeo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_predeo", referencedColumnName="id_predeo")
     * })
     */
    private $idPredeo;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Slika", mappedBy="idZivotinja", orphanRemoval=true)
     */
    private $slike = array();

    public function __construct() {
        $this->slike = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Get idZivotinja.
     *
     * @return int
     */
    public function getIdZivotinja()
    {
        return $this->idZivotinja;
    }

    /**
     * Set naziv.
     *
     * @param string $naziv
     *
     * @return Zivotinja
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
     * Set latinskiNaziv.
     *
     * @param string $latinskiNaziv
     *
     * @return Zivotinja
     */
    public function setLatinskiNaziv($latinskiNaziv)
    {
        $this->latinskiNaziv = $latinskiNaziv;

        return $this;
    }

    /**
     * Get latinskiNaziv.
     *
     * @return string
     */
    public function getLatinskiNaziv()
    {
        return $this->latinskiNaziv;
    }

    /**
     * Set naslovnaSlika.
     *
     * @param string $naslovnaSlika
     *
     * @return Zivotinja
     */
    public function setNaslovnaSlika($naslovnaSlika)
    {
        $this->naslovnaSlika = $naslovnaSlika;

        return $this;
    }

    /**
     * Get naslovnaSlika.
     *
     * @return string
     */
    public function getNaslovnaSlika()
    {
        return $this->naslovnaSlika;
    }

    /**
     * Set opis.
     *
     * @param string $opis
     *
     * @return Zivotinja
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;

        return $this;
    }

    /**
     * Get opis.
     *
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Set atrakcija.
     *
     * @param bool $atrakcija
     *
     * @return Zivotinja
     */
    public function setAtrakcija($atrakcija)
    {
        $this->atrakcija = $atrakcija;

        return $this;
    }

    /**
     * Get atrakcija.
     *
     * @return bool
     */
    public function getAtrakcija()
    {
        return $this->atrakcija;
    }

    /**
     * Set idPredeo.
     *
     * @param \App\Models\Entities\Predeo|null $idPredeo
     *
     * @return Zivotinja
     */
    public function setIdPredeo(\App\Models\Entities\Predeo $idPredeo = null)
    {
        $this->idPredeo = $idPredeo;

        return $this;
    }

    /**
     * Get idPredeo.
     *
     * @return \App\Models\Entities\Predeo|null
     */
    public function getIdPredeo()
    {
        return $this->idPredeo;
    }

    /**
     * Add slike.
     *
     * @param \App\Models\Entities\Slika $slike
     *
     * @return Zivotinja
     */
    public function addSlike(\App\Models\Entities\Slika $slike)
    {
        if (!$this->slike->contains($slike)) {
            $this->slike[] = $slike;
            $slike->setIdZivotinja($this);
        }
        return $this;
    }

    /**
     * Remove slike.
     *
     * @param \App\Models\Entities\Slika $slike
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSlike(\App\Models\Entities\Slika $slike)
    {
        if($this->slike->contains($slike)){
            if($slike->getIdZivotinja() == $this){
                $slike->setIdZivotinja(null);
            }
            return $this->slike->removeElement($slike);
        }
        return false;
    }

    /**
     * Get slike.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSlike()
    {
        return $this->slike;
    }
}
