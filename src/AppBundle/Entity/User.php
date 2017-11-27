<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 26/11/2017
 * Time: 19:24
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var WishList[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\WishList", mappedBy="creator")
     */
    private $wishLists;

    /**
     * Many Users have Many watched lists.
     * @var WishList[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\WishList", inversedBy="viewers")
     * @ORM\JoinTable(name="users_wish_lists")
     */
    private $watchedLists;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->wishLists = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add wishList
     *
     * @param \AppBundle\Entity\WishList $wishList
     *
     * @return User
     */
    public function addWishList(\AppBundle\Entity\WishList $wishList)
    {
        $this->wishLists[] = $wishList;

        return $this;
    }

    /**
     * Remove wishList
     *
     * @param \AppBundle\Entity\WishList $wishList
     */
    public function removeWishList(\AppBundle\Entity\WishList $wishList)
    {
        $this->wishLists->removeElement($wishList);
    }

    /**
     * Get wishLists
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWishLists()
    {
        return $this->wishLists;
    }

    /**
     * Add watchedList
     *
     * @param \AppBundle\Entity\WishList $watchedList
     *
     * @return User
     */
    public function addWatchedList(\AppBundle\Entity\WishList $watchedList)
    {
        $this->watchedLists[] = $watchedList;

        return $this;
    }

    /**
     * Remove watchedList
     *
     * @param \AppBundle\Entity\WishList $watchedList
     */
    public function removeWatchedList(\AppBundle\Entity\WishList $watchedList)
    {
        $this->watchedLists->removeElement($watchedList);
    }

    /**
     * Get watchedLists
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWatchedLists()
    {
        return $this->watchedLists;
    }
}
