<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes", indexes={@ORM\Index(name="fk_likeactualite", columns={"idactualite"}), @ORM\Index(name="fk_likeuser", columns={"iduser"})})
 * @ORM\Entity(repositoryClass="BackBundle\Repository\LikesRepository")
 */
class Likes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Actualite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idactualite", referencedColumnName="id" , onDelete="CASCADE" )
     * })
     */
    private $idactualite;

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     * })
     */
    private $iduser;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdactualite()
    {
        return $this->idactualite;
    }

    /**
     * @param mixed $idactualite
     */
    public function setIdactualite($idactualite)
    {
        $this->idactualite = $idactualite;
    }

    /**
     * @return mixed
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param mixed $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }



}

