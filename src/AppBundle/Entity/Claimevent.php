<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Claimevent
 *
 * @ORM\Table(name="claimevent")
 * @ORM\Entity(repositoryClass="BackBundle\Repository\ClaimRepository")
 */
class Claimevent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idclaimev", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idclaimev;



    /**
     * @var integer
     *@ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     *@ORM\JoinColumn(name="idUser", referencedColumnName="id")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=45, nullable=true)
     */
    private $statut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="claimdate", type="datetime", nullable=true)
     */
    private $claimdate;

    /**
     * @var string
     *
     * @ORM\Column(name="object", type="string", length=45, nullable=true)
     */
    private $object;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=254, nullable=true)
     */
    private $description;







    /**
     * @return int
     */
    public function getIdclaimev()
    {
        return $this->idclaimev;
    }

    /**
     * @param int $idclaimev
     */
    public function setIdclaimev($idclaimev)
    {
        $this->idclaimev = $idclaimev;
    }

    public function __construct()
    {
        $this->claimdate = new \DateTime();
    }

    /**
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }



    /**
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return \DateTime
     */
    public function getClaimdate()
    {
        return $this->claimdate;
    }

    /**
     * @param \DateTime $claimdate
     */
    public function setClaimdate($claimdate)
    {
        $this->claimdate = $claimdate;
    }

    /**
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param string $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }








}
