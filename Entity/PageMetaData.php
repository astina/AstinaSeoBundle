<?php

namespace Astina\Bundle\SeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Astina\Bundle\SeoBundle\Entity\PageMetaDataRepository")
 */
class PageMetaData
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hostname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2047, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=2047, nullable=true)
     */
    private $keywords;

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }

    public function getHostname()
    {
        return $this->hostname;
    }
}
