<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participant
 *
 * @ORM\Table(name="participant", indexes={@ORM\Index(name="IDX_D79F6B11E78A795B", columns={"idpay"})})
 * @ORM\Entity
 */
class Participant
{

    /**
     * @var integer
     *
     * @ORM\Column(name="idpart", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpart;

    /**
     * @return int
     */
    public function getIdpart()
    {
        return $this->idpart;
    }

    /**
     * @param int $idpart
     */
    public function setIdpart($idpart)
    {
        $this->idpart = $idpart;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="cin", type="integer", nullable=false)
     */
    private $cin;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var integer
     *
     * @ORM\Column(name="tlph", type="integer", nullable=false)
     */
    private $tlph;

    /**
     * @var \Pay
     *
     * @ORM\ManyToOne(targetEntity="Pay")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idpay", referencedColumnName="idcarte")
     * })
     */
    private $pay;

    /**
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param int $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return int
     */
    public function getTlph()
    {
        return $this->tlph;
    }

    /**
     * @param int $tlph
     */
    public function setTlph($tlph)
    {
        $this->tlph = $tlph;
    }

    /**
     * @return \Pay
     */
    public function getPay()
    {
        return $this->pay;
    }

    /**
     * @param \Pay $pay
     */
    public function setPay($pay)
    {
        $this->pay = $pay;
    }






}

