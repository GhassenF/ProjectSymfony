<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SBC\NotificationsBundle\Builder\NotificationBuilder;
use SBC\NotificationsBundle\Model\NotifiableInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Actualite
 *
 * @ORM\Table(name="actualite", indexes={@ORM\Index(name="IDX_549281978D93D649", columns={"user"}), @ORM\Index(name="IDX_549281973AF34668", columns={"categories"})})
 * @ORM\Entity(repositoryClass="BackBundle\Repository\ActualiteRepository")
 */
class Actualite implements NotifiableInterface
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="pictures", type="string", length=500, nullable=false)
     */
    private $pictures;

    /**
     * @var integer
     *
     * @ORM\Column(name="archivestatut", type="integer", nullable=false)
     */
    private $archivestatut = '1';

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categories", referencedColumnName="id")
     * })
     */
    private $categories;

    /**
     * @var \UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;
    /**
     * @var integer
     *
     * @ORM\Column(name="nbrelike", type="integer", nullable=false)
     */
    private $nbrelike ='0';

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
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @param string $pictures
     */
    public function setPictures($pictures)
    {
        $this->pictures = $pictures;
    }

    /**
     * @return int
     */
    public function getArchivestatut()
    {
        return $this->archivestatut;
    }

    /**
     * @param int $archivestatut
     */
    public function setArchivestatut($archivestatut)
    {
        $this->archivestatut = $archivestatut;
    }

    /**
     * @return \Category
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param \Category $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \UserBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function notificationsOnCreate(NotificationBuilder $builder)
    {
        $user = $this->getUser();
      $notif = new notif();
      $notif ->setTitle('Nouvelle Actualite')
          ->setDescription(" de Titre ".$this->titre." par établissement : ".$this->getUser())
          ->setRoute('consultactualite')

          ->setParameters(array('id'=> $this ->id))
          ->setUser($user);
        $builder ->addNotification($notif);
return $builder;
    }

    public function notificationsOnUpdate(NotificationBuilder $builder)
    {
        $user = $this->getUser();
        $notif = new notif();
        $notif ->setTitle('Mise a jour Actualite')
            ->setDescription(" de Titre ".$this->titre." par établissement : ".$this->getUser())
            ->setRoute('consultactualite')

            ->setParameters(array('id'=> $this ->id))
            ->setUser($user);
        $builder ->addNotification($notif);
        return $builder;

    }

    public function notificationsOnDelete(NotificationBuilder $builder)
    {
return $builder;
    }

    /**
     * @return int
     */
    public function getNbrelike()
    {
        return $this->nbrelike;
    }

    /**
     * @param int $nbrelike
     */
    public function setNbrelike($nbrelike)
    {
        $this->nbrelike = $nbrelike;
    }


}

