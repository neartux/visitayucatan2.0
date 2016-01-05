<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Estatus
 *
 * @ORM\Table(name="estatus")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\EstatusRepository")
 */
class Estatus
{
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="Moneda", mappedBy="estatus")
     */
    private $moneda;

    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="estatus")
     */
    private $usuario;


    /**
     * Constructor
     */
    public function __construct(){
        $this->moneda = new ArrayCollection();
        $this->usuario = new ArrayCollection();
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Estatus
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Add moneda
     *
     * @param \VisitaYucatanBundle\Entity\Moneda $moneda
     *
     * @return Estatus
     */
    public function addMoneda(\VisitaYucatanBundle\Entity\Moneda $moneda)
    {
        $this->moneda[] = $moneda;

        return $this;
    }

    /**
     * Remove moneda
     *
     * @param \VisitaYucatanBundle\Entity\Moneda $moneda
     */
    public function removeMoneda(\VisitaYucatanBundle\Entity\Moneda $moneda)
    {
        $this->moneda->removeElement($moneda);
    }

    /**
     * Get moneda
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Add usuario
     *
     * @param \VisitaYucatanBundle\Entity\Usuario $usuario
     *
     * @return Estatus
     */
    public function addUsuario(\VisitaYucatanBundle\Entity\Usuario $usuario)
    {
        $this->usuario[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \VisitaYucatanBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\VisitaYucatanBundle\Entity\Usuario $usuario)
    {
        $this->usuario->removeElement($usuario);
    }

    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
