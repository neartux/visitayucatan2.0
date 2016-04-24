<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosHotel
 *
 * @ORM\Table(name="datos_hotel")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\DatosHotelRepository")
 */
class DatosHotel {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="hotelpickup", type="string", length=100)
     */
    private $hotelPickUp;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set hotelPickUp
     *
     * @param string $hotelPickUp
     *
     * @return DatosHotel
     */
    public function setHotelPickUp($hotelPickUp)
    {
        $this->hotelPickUp = $hotelPickUp;

        return $this;
    }

    /**
     * Get hotelPickUp
     *
     * @return string
     */
    public function getHotelPickUp()
    {
        return $this->hotelPickUp;
    }
}

