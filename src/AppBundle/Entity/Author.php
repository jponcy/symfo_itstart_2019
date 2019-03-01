<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 *
 * @ORM\Entity()
 * @ORM\Table("app_author")
 * @ORM\HasLifecycleCallbacks()
 */
class Author
{

    /**
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     *
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $createdAt;

    /**
     *
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     *
     * @ORM\Column(type="string")
     * @NotNull()
     * @NotBlank()
     * @var string
     */
    private $lastname;

    /**
     *
     * @ORM\Column(type="string")
     * @NotNull()
     * @NotBlank()
     * @var string
     */
    private $firstname;

    /**
     *
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $surname;

    /**
     *
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private $birthdate;

    /**
     *
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $birthplace;

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prePersistOrUpdate()
    {
        if ($this->getId() === null) {
            $this->setCreatedAt(new \DateTime());
        }

        $this->setUpdatedAt(new \DateTime());
    }

    /**
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     *
     * @return string
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     *
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     *
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     *
     * @param \DateTime $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     *
     * @param string $birthplace
     */
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;
    }
}
