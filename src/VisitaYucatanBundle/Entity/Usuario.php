<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\UsuarioRepository")
 */
class Usuario {
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="comentarios", type="text", nullable=true)
     */
    private $comentarios;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="usuario")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToOne(targetEntity="Datospersonales")
     * @ORM\JoinColumn(name="id_datospersonales", referencedColumnName="id", nullable=false)
     */
    private $datosPersonales;

    /**
     * @ORM\OneToOne(targetEntity="Datosubicacion")
     * @ORM\JoinColumn(name="id_datosubicacion", referencedColumnName="id", nullable=false)
     */
    private $datosUbicacion;


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
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     *
     * @return Usuario
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return string
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Usuario
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

    /**
     * Set datosPersonales
     *
     * @param \VisitaYucatanBundle\Entity\Datospersonales $datosPersonales
     *
     * @return Usuario
     */
    public function setDatosPersonales(\VisitaYucatanBundle\Entity\Datospersonales $datosPersonales)
    {
        $this->datosPersonales = $datosPersonales;

        return $this;
    }

    /**
     * Get datosPersonales
     *
     * @return \VisitaYucatanBundle\Entity\Datospersonales
     */
    public function getDatosPersonales()
    {
        return $this->datosPersonales;
    }

    /**
     * Set datosUbicacion
     *
     * @param \VisitaYucatanBundle\Entity\Datosubicacion $datosUbicacion
     *
     * @return Usuario
     */
    public function setDatosUbicacion(\VisitaYucatanBundle\Entity\Datosubicacion $datosUbicacion)
    {
        $this->datosUbicacion = $datosUbicacion;

        return $this;
    }

    /**
     * Get datosUbicacion
     *
     * @return \VisitaYucatanBundle\Entity\Datosubicacion
     */
    public function getDatosUbicacion()
    {
        return $this->datosUbicacion;
    }
}
