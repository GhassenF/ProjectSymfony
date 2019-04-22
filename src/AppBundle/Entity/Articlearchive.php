<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articlearchive
 *
 * @ORM\Table(name="articlearchive")
 * @ORM\Entity
 */
class Articlearchive
{
    /**
     * @var integer
     *
     * @ORM\Column(name="identifiant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $identifiant;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=30, nullable=false)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="journal", type="string", length=30, nullable=false)
     */
    private $journal;

    /**
     * @return int
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * @param int $identifiant
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;
    }

    /**
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param string $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * @return string
     */
    public function getJournal()
    {
        return $this->journal;
    }

    /**
     * @param string $journal
     */
    public function setJournal($journal)
    {
        $this->journal = $journal;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * @param string $emplacement
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;
    }





    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="emplacement", type="string", length=255, nullable=false)
     */
    private $emplacement;





    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Statarticle")
     * @ORM\JoinColumn(name="idstat",referencedColumnName="idart")
     */




    private $Statarticle;

    /**
     * @return mixed
     */
    public function getStatarticle()
    {
        return $this->Statarticle;
    }

    /**
     * @param mixed $Statarticle
     */
    public function setStatarticle($Statarticle)
    {
        $this->Statarticle = $Statarticle;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="identifiantuser", type="string", length=35, nullable=false)
     */
    private $identifiantuser;
    /**
     * @return mixed
     */
    public function getIdentifiantuser()
    {
        return $this->identifiantuser;
    }

    /**
     * @param mixed $identifiantuser
     */
    public function setIdentifiantuser($identifiantuser)
    {
        $this->identifiantuser = $identifiantuser;
    }







}
