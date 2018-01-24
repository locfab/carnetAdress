<?php

namespace CA\PersoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friendship
 *
 * @ORM\Table(name="friendship")
 * @ORM\Entity(repositoryClass="CA\PersoBundle\Repository\FriendshipRepository")
 */
class Friendship
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="friend1", type="integer", unique=false)
     */
    private $friend1;

    /**
     * @var int
     *
     * @ORM\Column(name="friend2", type="integer", unique=false)
     */
    private $friend2;


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
     * Set friend1
     *
     * @param integer $friend1
     *
     * @return Friendship
     */
    public function setFriend1($friend1)
    {
        $this->friend1 = $friend1;

        return $this;
    }

    /**
     * Get friend1
     *
     * @return int
     */
    public function getFriend1()
    {
        return $this->friend1;
    }

    /**
     * Set friend2
     *
     * @param integer $friend2
     *
     * @return Friendship
     */
    public function setFriend2($friend2)
    {
        $this->friend2 = $friend2;

        return $this;
    }

    /**
     * Get friend2
     *
     * @return int
     */
    public function getFriend2()
    {
        return $this->friend2;
    }



}

