<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * WishList
 *
 * @ORM\Table(name="wish_list")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WishListRepository")
 */
class WishList
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="wishLists")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $creator;

    /**
     * @var User[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="watchedLists")
     */
    private $viewers;

    /**
     * @var Item[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Item", mappedBy="wishList")
     */
    private $items;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->viewers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return WishList
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set creator
     *
     * @param \AppBundle\Entity\User $creator
     *
     * @return WishList
     */
    public function setCreator(\AppBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Add viewer
     *
     * @param \AppBundle\Entity\User $viewer
     *
     * @return WishList
     */
    public function addViewer(\AppBundle\Entity\User $viewer)
    {
        $this->viewers[] = $viewer;

        return $this;
    }

    /**
     * Remove viewer
     *
     * @param \AppBundle\Entity\User $viewer
     */
    public function removeViewer(\AppBundle\Entity\User $viewer)
    {
        $this->viewers->removeElement($viewer);
    }

    /**
     * Get viewers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getViewers()
    {
        return $this->viewers;
    }

    /**
     * Add item
     *
     * @param \AppBundle\Entity\Item $item
     *
     * @return WishList
     */
    public function addItem(\AppBundle\Entity\Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \AppBundle\Entity\Item $item
     */
    public function removeItem(\AppBundle\Entity\Item $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}
