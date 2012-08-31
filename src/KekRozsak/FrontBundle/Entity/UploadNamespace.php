<?php
namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Namespace support for uploaded files
 *
 * @author Gergely Polonkai
 *
 * @ORM\Entity
 * @ORM\Table(name="upload_namespaces")
 */
class UploadNamespace
{
    /**
     * The ID of the namespace
     *
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

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
     * The name of the namespace. This will be used when displaying the
     * namespace list.
     *
     * @var string $name
     *
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     *
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * Set name
     *
     * @param  string $name
     * @return UploadNamespace
     */
    public function setName($name)
    {
        // TODO: Check if not null!
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
     * The slugified name of the namespace. This will be used in URLs
     *
     * @var string $slug
     *
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     */
    protected $slug;

    /**
     * Set slug
     *
     * @param  string $slug
     * @return UploadNamespace
     */
    public function setSlug($slug)
    {
        // TODO: Check if not null!
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
