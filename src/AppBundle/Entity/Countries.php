<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Countries
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
    private $country;

    /**
     * @ORM\Column(type="integer")
     */
    private $hotels;

    /**
     * @ORM\OneToMany(targetEntity="Destination", mappedBy="countries")
     */
    protected $destinations;

    /**
     * @return mixed
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * @param mixed $destinations
     */
    public function setDestinations($destinations)
    {
        $this->destinations = $destinations;
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
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
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