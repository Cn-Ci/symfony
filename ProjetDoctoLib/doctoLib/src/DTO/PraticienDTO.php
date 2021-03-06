<?php

namespace App\DTO;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class PraticienDTO
{
    /**
     * @OA\Property(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @OA\Property(type="string")
     *
     * @var string
     */
    private $nom;

    /**
     * @OA\Property(type="string")
     *
     * @var string
     */
    private $prenom;

    /**
     * @OA\Property(type="string")
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(type="string")
     *
     * @var string
     */
    private $password;

    /**
     * @OA\Property(type="string")
     *
     * @var string
     */
    private $specialite;

    /**
     * @OA\Property(type="integer")
     *
     * @var int
     */
    private $telephone;

    /** @OA\Property(
     *      type="RendezVousDTO",
     *      description="",
     *      type="array",
     *      items= {"type"="object"}
     * )
     *
     * @var array
     */
    private $rendezVouses;

    /** @OA\Property(
     *      type="AdresseDTO",
     *      description="",
     *      type="array",
     *      items= {"type"="object"}
     * )
     *
     * @var array
     */
    private $adresse;


    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }
 
    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password)
    {
        $this->password = $password;
        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(?string $specialite): self
    {
        $this->specialite = $specialite;
        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getRendezVouses(): array
    {
        return $this->rendezVouses;
    }

    public function setRendezVouses(array $rendezVouses): self
    {
        $this->rendezVouses = $rendezVouses;
        return $this;
    }

    public function getAdresse(): array
    {
        return $this->adresse;
    }

    public function setAdresse(array $adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }
}
