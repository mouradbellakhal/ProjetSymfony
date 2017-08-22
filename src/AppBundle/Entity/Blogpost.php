<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="blogpost")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Blogpost
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=36)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", unique=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $published_at;

    public function __construct($id)
    {
        $this->id = $id;
        $this->published_at = null;
    }
    /**
     * Set title
     *
     * @param string $title
     *
     * @return Blogpost
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
            /**
     * Set published_at
     *
     * @param string $published_at
     *
     * @return Blogpost
     */
    public function setPublished_at($published_at)
    {
        $this->published_at = $published_at;

        return $this;
    }
        /**
     * Set content
     *
     * @param string $content
     *
     * @return Blogpost
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
        /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
        /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Get published_at
     *
     * @return Datetime
     */
    public function getPublished_at()
    {
        return $this->published_at;
    }


}
