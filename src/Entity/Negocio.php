<?php

namespace App\Entity;

use App\Repository\NegocioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NegocioRepository::class)
 */
class Negocio
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ubicacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $googleMap;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $correo;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estatus;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $foto;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", length=33, nullable=true)
     */
    private $website;

    /**
     * @ORM\OneToMany(targetEntity=Categorias::class, mappedBy="empresa", orphanRemoval=true)
     */
    private $categorias;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $emenuurl;

    public function __construct($id = null)
    {
        if (!empty($id))
            $this->id = $id;
        $this->categorias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(string $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    public function getGoogleMap(): ?string
    {
        return $this->googleMap;
    }

    public function setGoogleMap(?string $googleMap): self
    {
        $this->googleMap = $googleMap;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(?string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEstatus(): ?bool
    {
        return $this->estatus;
    }

    public function setEstatus(?bool $estatus): self
    {
        $this->estatus = $estatus;

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection|Categorias[]
     */
    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categorias $categoria): self
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias[] = $categoria;
            $categoria->setNegocio($this);
        }

        return $this;
    }

    public function removeCategoria(Categorias $categoria): self
    {
        if ($this->categorias->contains($categoria)) {
            $this->categorias->removeElement($categoria);
            // set the owning side to null (unless already changed)
            if ($categoria->getNegocio() === $this) {
                $categoria->setNegocio(null);
            }
        }

        return $this;
    }

    public function getEmenuurl(): ?string
    {
        return $this->emenuurl;
    }

    public function setEmenuurl(?string $emenuurl): self
    {
        $this->emenuurl = $emenuurl;

        return $this;
    }
}
