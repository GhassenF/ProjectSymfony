<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="IDX_23A0E66B0C83DF6", columns={"IdentifiantUser"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
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
     * @return int
     */

    /**
     * @var string
     * @Assert\NotBlank(message="Please Select a File")
     * @Assert\File()
     * @ORM\Column(name="emplacement", type="string", length=255, nullable=false)
     */
    public $emplacement;
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



    /**

     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdentifiantUser", referencedColumnName="id")
     * })
     */



    private $identifiantuser;
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

}

