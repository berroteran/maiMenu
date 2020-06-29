<?php

namespace App\Entity;

use App\Repository\CategoriasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=CategoriasRepository::class)
 */
class Categorias
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}, nullable=true )
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"} , nullable=true)
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity=Producto::class, mappedBy="categoria")
     */
    private $productos;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Negocio::class, inversedBy="categorias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $empresa;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setActivo(?bool $activo): self
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection|Producto[]
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Producto $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->setCategoria($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        if ($this->productos->contains($producto)) {
            $this->productos->removeElement($producto);
            // set the owning side to null (unless already changed)
            if ($producto->getCategoria() === $this) {
                $producto->setCategoria(null);
            }
        }

        return $this;
    }

    public function getImage( ):?string
    {
        return $this->image;
    }

    public function setImage($fileImage): self
    {
        $this->image = $fileImage;

        return $this;
    }

    public function getEmpresa(): ?Negocio
    {
        return $this->empresa;
    }

    public function setEmpresa(?Negocio $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }
}
