<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pay
 *
 * @ORM\Table(name="pay")
 * @ORM\Entity
 */
class Pay
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcarte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcarte;

    /**
     * @var string
     *
     * @ORM\Column(name="numCarte", type="string", length=255, nullable=false)
     */
    private $numcarte;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     */
    private $code;

    /**
     * @var float
     *
     * @ORM\Column(name="solde", type="float", precision=10, scale=0, nullable=false)
     */
    private $solde;

    /**
     * @return int
     */
    public function getIdcarte()
    {
        return $this->idcarte;
    }

    /**
     * @param int $idcarte
     */
    public function setIdcarte($idcarte)
    {
        $this->idcarte = $idcarte;
    }

    /**
     * @return string
     */
    public function getNumcarte()
    {
        return $this->numcarte;
    }

    /**
     * @param string $numcarte
     */
    public function setNumcarte($numcarte)
    {
        $this->numcarte = $numcarte;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return float
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * @param float $solde
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;
    }



}

