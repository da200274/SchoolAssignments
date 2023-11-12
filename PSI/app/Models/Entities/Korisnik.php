<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Korisnik
 *
 * @ORM\Table(name="korisnik")
 * @ORM\Entity(repositoryClass="App\Models\Repositories\KorisnikRepository")
 */
class Korisnik
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="korime", type="string", length=45, nullable=false)
     */
    private $korime;

    /**
     * @var string
     *
     * @ORM\Column(name="lozinka", type="string", length=45, nullable=false)
     */
    private $lozinka;

    /**
     * @var string
     *
     * @ORM\Column(name="ime", type="string", length=45, nullable=false)
     */
    private $ime;

    /**
     * @var string
     *
     * @ORM\Column(name="prezime", type="string", length=45, nullable=false)
     */
    private $prezime;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="drzava", type="string", length=45, nullable=false)
     */
    private $drzava;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=45, nullable=false)
     */
    private $role;

    /**
     * @var bool
     *
     * @ORM\Column(name="banovan", type="boolean", nullable=false)
     */
    private $banovan;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Lajkovi", mappedBy="idUser")
     */
    private $lajkovi = array();

    public function __construct() {
        $this->lajkovi = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idUser.
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set korime.
     *
     * @param string $korime
     *
     * @return Korisnik
     */
    public function setKorime($korime)
    {
        $this->korime = $korime;

        return $this;
    }

    /**
     * Get korime.
     *
     * @return string
     */
    public function getKorime()
    {
        return $this->korime;
    }

    /**
     * Set lozinka.
     *
     * @param string $lozinka
     *
     * @return Korisnik
     */
    public function setLozinka($lozinka)
    {
        $this->lozinka = $lozinka;

        return $this;
    }

    /**
     * Get lozinka.
     *
     * @return string
     */
    public function getLozinka()
    {
        return $this->lozinka;
    }

    /**
     * Set ime.
     *
     * @param string $ime
     *
     * @return Korisnik
     */
    public function setIme($ime)
    {
        $this->ime = $ime;

        return $this;
    }

    /**
     * Get ime.
     *
     * @return string
     */
    public function getIme()
    {
        return $this->ime;
    }

    /**
     * Set prezime.
     *
     * @param string $prezime
     *
     * @return Korisnik
     */
    public function setPrezime($prezime)
    {
        $this->prezime = $prezime;

        return $this;
    }

    /**
     * Get prezime.
     *
     * @return string
     */
    public function getPrezime()
    {
        return $this->prezime;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Korisnik
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set drzava.
     *
     * @param string $drzava
     *
     * @return Korisnik
     */
    public function setDrzava($drzava)
    {
        $this->drzava = $drzava;

        return $this;
    }

    /**
     * Get drzava.
     *
     * @return string
     */
    public function getDrzava()
    {
        return $this->drzava;
    }

    /**
     * Set role.
     *
     * @param string $role
     *
     * @return Korisnik
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set banovan.
     *
     * @param bool $banovan
     *
     * @return Korisnik
     */
    public function setBanovan($banovan)
    {
        $this->banovan = $banovan;

        return $this;
    }

    /**
     * Get banovan.
     *
     * @return bool
     */
    public function getBanovan()
    {
        return $this->banovan;
    }

    /**
     * Add lajkovi.
     *
     * @param \App\Models\Entities\Lajkovi $lajkovi
     *
     * @return Korisnik
     */
    public function addLajkovi(\App\Models\Entities\Lajkovi $lajkovi)
    {
        if (!$this->lajkovi->contains($lajkovi)) {
            $this->lajkovi[] = $lajkovi;
            $lajkovi->setIdUser($this);
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
            if($lajkovi->getIdUser() == $this){
                $lajkovi->setIdUser(null);
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
    }}
