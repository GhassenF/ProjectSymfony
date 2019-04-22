<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statarticle
 *
 * @ORM\Table(name="statarticle")
 * @ORM\Entity
 */
class Statarticle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idart", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idart;

    /**
     * @return int
     */
    public function getIdart()
    {
        return $this->idart;
    }

    /**
     * @param int $idart
     */
    public function setIdart($idart)
    {
        $this->idart = $idart;
    }

    /**
     * @return int
     */
    public function getNbrvue()
    {
        return $this->nbrvue;
    }

    /**
     * @param int $nbrvue
     */
    public function setNbrvue($nbrvue)
    {
        $this->nbrvue = $nbrvue;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }


    /**
     * @var integer
     *
     * @ORM\Column(name="nbrvue", type="integer", nullable=false)
     */
    private $nbrvue;


    /**
     * @var float
     *
     * @ORM\Column(name="score", type="float", precision=10, scale=0, nullable=false)
     */
    private $score;


}

