<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemRepository")
 */
class Item
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
     * @var string
     *
     * @ORM\Column(name="site", type="text")
     */
    private $site;

    /**
     * @var WishList
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\WishList", inversedBy="items")
     * @ORM\JoinColumn(name="wish_list_id", referencedColumnName="id")
     */
    private $wishList;


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
     * @return Item
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
     * Set site
     *
     * @param string $site
     *
     * @return Item
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set wishList
     *
     * @param \AppBundle\Entity\WishList $wishList
     *
     * @return Item
     */
    public function setWishList(\AppBundle\Entity\WishList $wishList = null)
    {
        $this->wishList = $wishList;

        return $this;
    }

    /**
     * Get wishList
     *
     * @return \AppBundle\Entity\WishList
     */
    public function getWishList()
    {
        return $this->wishList;
    }
}
