<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Country
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $hotels;

    /**
     * @ORM\OneToMany(targetEntity="City", mappedBy="Country")
     */
    protected $cities;

    /**
     * @ORM\OneToMany(targetEntity="Airport", mappedBy="Country")
     */
    protected $airports;

    /**
     * @return mixed
     */
    public function getAirports()
    {
        return $this->airports;
    }

    /**
     * @param mixed $airports
     */
    public function setAirports($airports)
    {
        $this->airports = $airports;
    }

    /**
     * @return mixed
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * @param mixed $cities
     */
    public function setCities($cities)
    {
        $this->cities = $cities;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getHotels()
    {
        return $this->hotels;
    }

    /**
     * @param mixed $hotels
     */
    public function setHotels($hotels)
    {
        $this->hotels = $hotels;
    }

}