<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity=Negocio::class, inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idnegocio;


    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity=Categorias::class, inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idcategoria;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $fechaModificacion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $usuarioAlta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $usuarioBaja;

    /**
     * @ORM\Column(type="boolean", )
     */
    private $activo;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="float", precision=2, scale=1))
     */
    private $precio;

    /**
     * @ORM\Column(type="boolean")
     */
    private $promocion;


    function __construct()
    {
        $this->fechaAlta = new \DateTime();
        $this->fechaModificacion = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdcategoria(): ?int
    {
        return $this->idcategoria;
    }

    public function setIdcategoria(?int $idcategoria): self
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(\DateTimeInterface $fechaAlta): self
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    public function getFechaModificacion(): ?\DateTimeInterface
    {
        return $this->fechaModificacion;
    }

    public function setFechaModificacion(?\DateTimeInterface $fechaModificacion): self
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    public function getUsuarioAlta(): ?int
    {
        return $this->usuarioAlta;
    }

    public function setUsuarioAlta(?int $usuarioAlta): self
    {
        $this->usuarioAlta = $usuarioAlta;

        return $this;
    }

    public function getUsuarioBaja(): ?int
    {
        return $this->usuarioBaja;
    }

    public function setUsuarioBaja(?int $usuarioBaja): self
    {
        $this->usuarioBaja = $usuarioBaja;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getPromocion(): ?bool
    {
        return $this->promocion;
    }

    public function setPromocion(bool $promocion): self
    {
        $this->promocion = $promocion;

        return $this;
    }

    public function getCategoria(): ?Categorias
    {
        return $this->categoria;
    }

    public function setCategoria(?Categorias $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }
}
