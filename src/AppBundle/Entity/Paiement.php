<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement")
 * @ORM\Entity
 */
class Paiement
{
    /**
     * @return string
     */
    public function getNumcartebancaire()
    {
        return $this->numcartebancaire;
    }

    /**
     * @param string $numcartebancaire
     */
    public function setNumcartebancaire($numcartebancaire)
    {
        $this->numcartebancaire = $numcartebancaire;
    }

    /**
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param string $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="numCarteBancaire", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numcartebancaire;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255, nullable=false)
     */
    private $mdp;

}
