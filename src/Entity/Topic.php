<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic", indexes={@ORM\Index(name="Topic_Categorie0_FK", columns={"id_categorie"}), @ORM\Index(name="Topic_User_FK", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="App\Repository\TopicRepository")
 */
class Topic
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_topic", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTopic;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_topic", type="string", length=100, nullable=false)
     */
    private $titreTopic;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_topic", type="string", length=5000, nullable=false)
     */
    private $texteTopic;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categorie", referencedColumnName="id_categorie")
     * })
     */
    private $idCategorie;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    public function getIdTopic(): ?int
    {
        return $this->idTopic;
    }

    public function getTitreTopic(): ?string
    {
        return $this->titreTopic;
    }

    public function setTitreTopic(string $titreTopic): self
    {
        $this->titreTopic = $titreTopic;

        return $this;
    }

    public function getTexteTopic(): ?string
    {
        return $this->texteTopic;
    }

    public function setTexteTopic(string $texteTopic): self
    {
        $this->texteTopic = $texteTopic;

        return $this;
    }

    public function getIdCategorie(): ?Categorie
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?Categorie $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

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
