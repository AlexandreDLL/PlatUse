<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveau
 *
 * @ORM\Table(name="niveau")
 * @ORM\Entity(repositoryClass="App\Repository\NiveauRepository")
 */
class Niveau
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_niveau", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNiveau;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_niveau", type="integer", nullable=false)
     */
    private $numeroNiveau;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_niveau", type="string", length=100, nullable=true)
     */
    private $nomNiveau;

    public function getIdNiveau(): ?int
    {
        return $this->idNiveau;
    }

    public function getNumeroNiveau(): ?int
    {
        return $this->numeroNiveau;
    }

    public function setNumeroNiveau(int $numeroNiveau): self
    {
        $this->numeroNiveau = $numeroNiveau;

        return $this;
    }

    public function getNomNiveau(): ?string
    {
        return $this->nomNiveau;
    }

    public function setNomNiveau(?string $nomNiveau): self
    {
        $this->nomNiveau = $nomNiveau;

        return $this;
    }


}

?>