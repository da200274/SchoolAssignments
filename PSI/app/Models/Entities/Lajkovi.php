<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lajkovi
 *
 * @ORM\Table(name="lajkovi", indexes={@ORM\Index(name="lajkovi_ibfk_1", columns={"id_user"}), @ORM\Index(name="lajkovi_ibfk_2", columns={"id_slika"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\LajkoviRepository")
 */
class Lajkovi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_lajk", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLajk;

    /**
     * @var bool
     *
     * @ORM\Column(name="flag", type="boolean", nullable=false)
     */
    private $flag;

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
     * @var \App\Models\Entities\Slika
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Slika")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_slika", referencedColumnName="id_slika")
     * })
     */
    private $idSlika;



    /**
     * Get idLajk.
     *
     * @return int
     */
    public function getIdLajk()
    {
        return $this->idLajk;
    }

    /**
     * Set flag.
     *
     * @param bool $flag
     *
     * @return Lajkovi
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag.
     *
     * @return bool
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set idUser.
     *
     * @param \App\Models\Entities\Korisnik|null $idUser
     *
     * @return Lajkovi
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
     * Set idSlika.
     *
     * @param \App\Models\Entities\Slika|null $idSlika
     *
     * @return Lajkovi
     */
    public function setIdSlika(\App\Models\Entities\Slika $idSlika = null)
    {
        $this->idSlika = $idSlika;

        return $this;
    }

    /**
     * Get idSlika.
     *
     * @return \App\Models\Entities\Slika|null
     */
    public function getIdSlika()
    {
        return $this->idSlika;
    }
}
