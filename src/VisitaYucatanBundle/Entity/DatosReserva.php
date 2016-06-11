<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosReserva
 *
 * @ORM\Table(name="datos_reserva")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\DatosReservaRepository")
 */
class DatosReserva {
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
     * @ORM\Column(name="hotelpickup", type="string", length=100, nullable=true)
     */
    private $hotelPickUp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checkin", type="date", nullable=true)
     */
    private $checkIn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checkout", type="date", nullable=true)
     */
    private $checkOut;


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
     * @return DatosReserva
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

    /**
     * @return \DateTime
     */
    public function getCheckIn()
    {
        return $this->checkIn;
    }

    /**
     * @param \DateTime $checkIn
     */
    public function setCheckIn($checkIn)
    {
        $this->checkIn = $checkIn;
    }

    /**
     * @return \DateTime
     */
    public function getCheckOut()
    {
        return $this->checkOut;
    }

    /**
     * @param \DateTime $checkOut
     */
    public function setCheckOut($checkOut)
    {
        $this->checkOut = $checkOut;
    }
    
    
}
