<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reglement = null;

    #[ORM\Column(nullable: true)]
    private ?int $reduction = null;

    #[ORM\Column(nullable: true)]
    private ?float $coefClient = null;

    #[ORM\Column(length: 255)]
    private ?string $nomClient = null;

    #[ORM\Column(length: 255)]
    private ?string $prenomClient = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dateFacture = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseFacture = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseLivraison = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: BonLivraison::class)]
    private Collection $bonLivraison;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Contient::class)]
    private Collection $contient;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->bonLivraison = new ArrayCollection();
        $this->contient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getReglement(): ?string
    {
        return $this->reglement;
    }

    public function setReglement(?string $reglement): self
    {
        $this->reglement = $reglement;

        return $this;
    }

    public function getReduction(): ?int
    {
        return $this->reduction;
    }

    public function setReduction(?int $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getCoefClient(): ?float
    {
        return $this->coefClient;
    }

    public function setCoefClient(?float $coefClient): self
    {
        $this->coefClient = $coefClient;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    public function getDateFacture(): ?\DateTimeImmutable
    {
        return $this->dateFacture;
    }

    public function setDateFacture(?\DateTimeImmutable $dateFacture): self
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }

    public function getAdresseFacture(): ?string
    {
        return $this->adresseFacture;
    }

    public function setAdresseFacture(string $adresseFacture): self
    {
        $this->adresseFacture = $adresseFacture;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison(string $adresseLivraison): self
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, BonLivraison>
     */
    public function getBonLivraison(): Collection
    {
        return $this->bonLivraison;
    }

    public function addBonLivraison(BonLivraison $bonLivraison): self
    {
        if (!$this->bonLivraison->contains($bonLivraison)) {
            $this->bonLivraison->add($bonLivraison);
            $bonLivraison->setCommande($this);
        }

        return $this;
    }

    public function removeBonLivraison(BonLivraison $bonLivraison): self
    {
        if ($this->bonLivraison->removeElement($bonLivraison)) {
            // set the owning side to null (unless already changed)
            if ($bonLivraison->getCommande() === $this) {
                $bonLivraison->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contient>
     */
    public function getContient(): Collection
    {
        return $this->contient;
    }

    public function addContient(Contient $contient): self
    {
        if (!$this->contient->contains($contient)) {
            $this->contient->add($contient);
            $contient->setCommande($this);
        }

        return $this;
    }

    public function removeContient(Contient $contient): self
    {
        if ($this->contient->removeElement($contient)) {
            // set the owning side to null (unless already changed)
            if ($contient->getCommande() === $this) {
                $contient->setCommande(null);
            }
        }

        return $this;
    }
}
