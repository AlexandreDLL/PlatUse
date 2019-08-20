<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table(name="score", indexes={@ORM\Index(name="Score_User0_FK", columns={"id_user"}), @ORM\Index(name="Score_Niveau_FK", columns={"id_niveau"})})
 * @ORM\Entity(repositoryClass="App\Repository\ScoreRepository")
 */
class Score
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_score", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idScore;

    /**
     * @var float
     *
     * @ORM\Column(name="temps_score", type="float", precision=10, scale=0, nullable=false)
     */
    private $tempsScore;

    /**
     * @var \Niveau
     *
     * @ORM\ManyToOne(targetEntity="Niveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_niveau", referencedColumnName="id_niveau")
     * })
     */
    private $idNiveau;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    public function getIdScore(): ?int
    {
        return $this->idScore;
    }

    public function getTempsScore(): ?float
    {
        return $this->tempsScore;
    }

    public function setTempsScore(float $tempsScore): self
    {
        $this->tempsScore = $tempsScore;

        return $this;
    }

    public function getIdNiveau(): ?Niveau
    {
        return $this->idNiveau;
    }

    public function setIdNiveau(?Niveau $idNiveau): self
    {
        $this->idNiveau = $idNiveau;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
