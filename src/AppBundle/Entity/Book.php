<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass = "AppBundle\Repository\BookRepository")
 * @ORM\Table(name = "app_book")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type = "string", unique = true)
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(min = 3, max = 255)
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type = "text")
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type = "float")
     *
     * @Assert\NotNull()
     * @Assert\Range(min = 1, max = 12000)
     *
     * @var float
     */
    private $price;

    /**
     * @ORM\Column(type = "integer")
     *
     * @Assert\NotNull()
     * @Assert\Range(min = 0)
     *
     * @var integer
     */
    private $stock;

    /**
     * @ORM\Column(type = "string")
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     *
     * @var string
     */
    private $author;

    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return number
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return number
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param number $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param number $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }
}
