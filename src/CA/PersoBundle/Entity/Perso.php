<?php

namespace CA\PersoBundle\Entity;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Perso
 *
 * @ORM\Table(name="perso")
 * @ORM\Entity(repositoryClass="CA\PersoBundle\Repository\PersoRepository")
 */
class Perso extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;


    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255, nullable=true)
     */
    private $race;

    /**
     * @ORM\ManyToMany(targetEntity="CA\PersoBundle\Entity\Nourriture", cascade={"persist"})
     */
    private $nourriture;

    /**
     * @ORM\OneToOne(targetEntity="CA\PersoBundle\Entity\Famille", cascade={"persist"})
     */
    private $famille;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Perso
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }



    /**
     * Set race
     *
     * @param string $race
     *
     * @return Perso
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set nourriture
     *
     * @param string $nourriture
     *
     * @return Perso
     */


    /**
     * Add nourriture
     *
     * @param \CA\PersoBundle\Entity\Nourriture $nourriture
     *
     * @return Perso
     */
    public function addNourriture(\CA\PersoBundle\Entity\Nourriture $nourriture)
    {
        $this->nourriture[] = $nourriture;

        return $this;
    }

    /**
     * Remove nourriture
     *
     * @param \CA\PersoBundle\Entity\Nourriture $nourriture
     */
    public function removeNourriture(\CA\PersoBundle\Entity\Nourriture $nourriture)
    {
        $this->nourriture->removeElement($nourriture);
    }

    /**
     * Get nourriture
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNourriture()
    {
        return $this->nourriture;
    }

    /**
     * Set famille
     *
     * @param \CA\PersoBundle\Entity\Famille $famille
     *
     * @return Perso
     */
    public function setFamille(\CA\PersoBundle\Entity\Famille $famille = null)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return \CA\PersoBundle\Entity\Famille
     */
    public function getFamille()
    {
        return $this->famille;
    }
}
