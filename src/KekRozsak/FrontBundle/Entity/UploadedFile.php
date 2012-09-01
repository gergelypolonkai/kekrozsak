<?php
namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of UploadedFile
 *
 * @author Gergely Polonkai
 *
 * @ORM\Entity
 * @ORM\Table(name="uploaded_files", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"upload_namespace_id", "filename"})
 * })
 */
class UploadedFile
{
    /**
     * The ID of the file
     *
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * Get ID
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Namespace of the file
     *
     * @var UploadNamespace $namespace
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\FrontBundle\Entity\UploadNamespace")
     * @ORM\JoinColumn(name="upload_namespace_id", nullable=false)
     */
    protected $namespace;

    /**
     * Set namespace
     *
     * @param  KekRozsak\FrontBundle\Entity\UploadNamespace $namespace
     * @return UploadedFile
     */
    public function setNamespace(UploadNamespace $namespace)
    {
        // TODO: Check if not null!
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Get namespace
     *
     * @return KekRozsak\FrontBundle\Entity\UploadNamespace
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * The file name, as seen in the filesystem
     *
     * @var string $filename
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     */
    protected $filename;

    /**
     * Set filename
     *
     * @param  string       $filename
     * @return UploadedFile
     */
    public function setFilename($filename)
    {
        // TODO: Check if not null nor empty!
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Get filename with namespace
     *
     * @return string
     */
    public function getNsFilename()
    {
        return $this->namespace->getSlug() . DIRECTORY_SEPARATOR . $this->filename;
    }

    /**
     * MIME type of the file
     *
     * @var string $mimetype
     *
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected $mimeType;

    /**
     * Set mimeType
     *
     * @param  string       $mimeType
     * @return UploadedFile
     */
    public function setMimeType($mimeType)
    {
        // TODO: Check if not null nor empty!
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Description of the file
     *
     * @var string $description
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * Set description
     *
     * @param  string       $description
     * @return UploadedFile
     */
    public function setDescription($description)
    {
        if ($description === '') {
            $description = null;
        }

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
