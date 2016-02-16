<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaqueteItinerario
 *
 * @ORM\Table(name="paquete_itinerario")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\PaqueteItinerarioRepository")
 */
class PaqueteItinerario {
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
     * @ORM\Column(name="itinerario", type="text")
     */
    private $itinerario;

    /**
     * @var int
     *
     * @ORM\Column(name="dias", type="integer")
     */
    private $dias;

    /**
     * @ORM\ManyToOne(targetEntity="Paquete", inversedBy="paqueteItinerario")
     * @ORM\JoinColumn(name="id_paquete", referencedColumnName="id", nullable=false)
     */
    private $paquete;

    /**
     * @ORM\ManyToOne(targetEntity="Idioma", inversedBy="paqueteItinerario")
     * @ORM\JoinColumn(name="id_idioma", referencedColumnName="id", nullable=false)
     */
    private $idioma;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="paqueteItinerario")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


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
     * Set itinerario
     *
     * @param string $itinerario
     *
     * @return PaqueteItinerario
     */
    public function setItinerario($itinerario)
    {
        $this->itinerario = $itinerario;

        return $this;
    }

    /**
     * Get itinerario
     *
     * @return string
     */
    public function getItinerario()
    {
        return $this->itinerario;
    }

    /**
     * Set dias
     *
     * @param integer $dias
     *
     * @return PaqueteItinerario
     */
    public function setDias($dias)
    {
        $this->dias = $dias;

        return $this;
    }

    /**
     * Get dias
     *
     * @return int
     */
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * Set paquete
     *
     * @param \VisitaYucatanBundle\Entity\Paquete $paquete
     *
     * @return PaqueteItinerario
     */
    public function setPaquete(\VisitaYucatanBundle\Entity\Paquete $paquete)
    {
        $this->paquete = $paquete;

        return $this;
    }

    /**
     * Get paquete
     *
     * @return \VisitaYucatanBundle\Entity\Paquete
     */
    public function getPaquete()
    {
        return $this->paquete;
    }

    /**
     * Set idioma
     *
     * @param \VisitaYucatanBundle\Entity\Idioma $idioma
     *
     * @return PaqueteItinerario
     */
    public function setIdioma(\VisitaYucatanBundle\Entity\Idioma $idioma)
    {
        $this->idioma = $idioma;

        return $this;
    }

    /**
     * Get idioma
     *
     * @return \VisitaYucatanBundle\Entity\Idioma
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return PaqueteItinerario
     */
    public function setEstatus(\VisitaYucatanBundle\Entity\Estatus $estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return \VisitaYucatanBundle\Entity\Estatus
     */
    public function getEstatus()
    {
        return $this->estatus;
    }
}
