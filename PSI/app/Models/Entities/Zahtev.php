<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zahtev
 *
 * @ORM\Table(name="zahtev", indexes={@ORM\Index(name="zahtev_ibfk_2", columns={"tip_zahteva"}), @ORM\Index(name="zahtev_ibfk_1", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\ZahtevRepository")
 */
class Zahtev
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_zahtev", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idZahtev;

    /**
     * @var string
     *
     * @ORM\Column(name="naziv_predela", type="string", length=255, nullable=false)
     */
    private $nazivPredela;

    /**
     * @var string
     *
     * @ORM\Column(name="opis_predela", type="text", length=65535, nullable=false)
     */
    private $opisPredela;

    /**
     * @var string
     *
     * @ORM\Column(name="naziv_zivotinje", type="string", length=255, nullable=false)
     */
    private $nazivZivotinje;

    /**
     * @var string
     *
     * @ORM\Column(name="lat_naziv_zivotinje", type="string", length=255, nullable=false)
     */
    private $latNazivZivotinje;

    /**
     * @var string
     *
     * @ORM\Column(name="opis_zivotinje", type="text", length=65535, nullable=false)
     */
    private $opisZivotinje;

    /**
     * @var string
     *
     * @ORM\Column(name="slika_predela", type="string", length=255, nullable=false)
     */
    private $slikaPredela;

    /**
     * @var string
     *
     * @ORM\Column(name="slika_zivotinje", type="string", length=255, nullable=false)
     */
    private $slikaZivotinje;

    /**
     * @var string
     *
     * @ORM\Column(name="komentar", type="text", length=65535, nullable=false)
     */
    private $komentar;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false, options={"default"="pending"})
     */
    private $status = 'pending';

    /**
     * @var \App\Models\Entities\Korisnik
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Korisnik")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    /**
     * @var \App\Models\Entities\Tip
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Tip")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tip_zahteva", referencedColumnName="id_tip")
     * })
     */
    private $tipZahteva;



    /**
     * Get idZahtev.
     *
     * @return int
     */
    public function getIdZahtev()
    {
        return $this->idZahtev;
    }

    /**
     * Set nazivPredela.
     *
     * @param string $nazivPredela
     *
     * @return Zahtev
     */
    public function setNazivPredela($nazivPredela)
    {
        $this->nazivPredela = $nazivPredela;

        return $this;
    }

    /**
     * Get nazivPredela.
     *
     * @return string
     */
    public function getNazivPredela()
    {
        return $this->nazivPredela;
    }

    /**
     * Set opisPredela.
     *
     * @param string $opisPredela
     *
     * @return Zahtev
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
     * Set nazivZivotinje.
     *
     * @param string $nazivZivotinje
     *
     * @return Zahtev
     */
    public function setNazivZivotinje($nazivZivotinje)
    {
        $this->nazivZivotinje = $nazivZivotinje;

        return $this;
    }

    /**
     * Get nazivZivotinje.
     *
     * @return string
     */
    public function getNazivZivotinje()
    {
        return $this->nazivZivotinje;
    }

    /**
     * Set latNazivZivotinje.
     *
     * @param string $latNazivZivotinje
     *
     * @return Zahtev
     */
    public function setLatNazivZivotinje($latNazivZivotinje)
    {
        $this->latNazivZivotinje = $latNazivZivotinje;

        return $this;
    }

    /**
     * Get latNazivZivotinje.
     *
     * @return string
     */
    public function getLatNazivZivotinje()
    {
        return $this->latNazivZivotinje;
    }

    /**
     * Set opisZivotinje.
     *
     * @param string $opisZivotinje
     *
     * @return Zahtev
     */
    public function setOpisZivotinje($opisZivotinje)
    {
        $this->opisZivotinje = $opisZivotinje;

        return $this;
    }

    /**
     * Get opisZivotinje.
     *
     * @return string
     */
    public function getOpisZivotinje()
    {
        return $this->opisZivotinje;
    }

    /**
     * Set slikaPredela.
     *
     * @param string $slikaPredela
     *
     * @return Zahtev
     */
    public function setSlikaPredela($slikaPredela)
    {
        $this->slikaPredela = $slikaPredela;

        return $this;
    }

    /**
     * Get slikaPredela.
     *
     * @return string
     */
    public function getSlikaPredela()
    {
        return $this->slikaPredela;
    }

    /**
     * Set slikaZivotinje.
     *
     * @param string $slikaZivotinje
     *
     * @return Zahtev
     */
    public function setSlikaZivotinje($slikaZivotinje)
    {
        $this->slikaZivotinje = $slikaZivotinje;

        return $this;
    }

    /**
     * Get slikaZivotinje.
     *
     * @return string
     */
    public function getSlikaZivotinje()
    {
        return $this->slikaZivotinje;
    }

    /**
     * Set komentar.
     *
     * @param string $komentar
     *
     * @return Zahtev
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
     * Set status.
     *
     * @param string $status
     *
     * @return Zahtev
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set idUser.
     *
     * @param \App\Models\Entities\Korisnik|null $idUser
     *
     * @return Zahtev
     */
    public function setIdUser(\App\Models\Entities\Korisnik $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser.
     *
     * @return \App\Models\Entities\Korisnik|null
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set tipZahteva.
     *
     * @param \App\Models\Entities\Tip|null $tipZahteva
     *
     * @return Zahtev
     */
    public function setTipZahteva(\App\Models\Entities\Tip $tipZahteva = null)
    {
        $this->tipZahteva = $tipZahteva;

        return $this;
    }

    /**
     * Get tipZahteva.
     *
     * @return \App\Models\Entities\Tip|null
     */
    public function getTipZahteva()
    {
        return $this->tipZahteva;
    }
}
