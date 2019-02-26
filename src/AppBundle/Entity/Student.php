<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass = "AppBundle\Repository\StudentRepository")
 */
class Student
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @ORM\Column(type = "integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type = "string", nullable = true)
     * @var string
     */
    private $lastname;

    /**
     * @ORM\Column(type = "string")
     * @var string
     */
    private $firstname;

    /**
     * @ORM\Column(type = "boolean")
     * @var bool
     */
    private $enabled = true;

    /**
     * @return number
     */
    public final function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public final function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public final function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return boolean
     */
    public final function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param string $lastname
     */
    public final function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @param string $firstname
     */
    public final function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param boolean $enabled
     */
    public final function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
}

