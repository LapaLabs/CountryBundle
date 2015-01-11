<?php

namespace LapaLabs\CountryBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractCountry
 */
abstract class AbstractCountry
{
    protected $id;

    /**
     * The arbitrary country name
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * The country ISO 3166 code
     *
     * @var string
     *
     * @ORM\Column(type="string", length=2)
     */
    protected $code;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $published = true;

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
     * @return AbstractCountry
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
     * Set code
     *
     * @param string $code
     * @return AbstractCountry
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set published
     *
     * @param float $published
     * @return AbstractCountry
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return float
     */
    public function isPublished()
    {
        return $this->published;
    }
}
