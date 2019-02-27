<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass = "AppBundle\Repository\CompanyRepository")
 * @ORM\Table(name = "app_company")
 */
class Company
{

    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name = "label", type = "string", length = 125, unique = true)
     * @var string
     */
    private $name;

    /**
     * @return mixed
     */
    public final function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public final function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public final function setName($name)
    {
        $this->name = $name;
    }
}

