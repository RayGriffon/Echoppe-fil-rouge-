<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\Column(length: 255)]
    private ?string $reglement = null;

    #[ORM\Column]
    private ?float $reduction = null;

    #[ORM\Column]
    private ?float $coefClient = null;

    #[ORM\Column(length: 255)]
    private ?string $nomClient = null;

    #[ORM\Column(length: 255)]
    private ?string $prenomClient = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFacture = null;

    #[ORM\Column]
    private ?int $numRueFacture = null;

    #[ORM\Column(length: 255)]
    private ?string $nomRueFacture = null;

    #[ORM\Column(length: 255)]
    private ?string $nomVilleFacture = null;

    #[ORM\Column(length: 255)]
    private ?string $cpFacture = null;

    #[ORM\Column(length: 255)]
    private ?string $paysFacture = null;

    #[ORM\Column]
    private ?int $numRueLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $nomRueLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $nomVilleLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $cpLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $paysLivraison = null;

    #[ORM\ManyToOne(inversedBy: 'commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: BonLivraison::class)]
    private Collection $bonLivraison;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Contient::class)]
    private Collection $contients;

    public function __construct()
    {
        $this->bonLivraison = new ArrayCollection();
        $this->contients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getReglement(): ?string
    {
        return $this->reglement;
    }

    public function setReglement(string $reglement): self
    {
        $this->reglement = $reglement;

        return $this;
    }

    public function getReduction(): ?float
    {
        return $this->reduction;
    }

    public function setReduction(float $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getCoefClient(): ?float
    {
        return $this->coefClient;
    }

    public function setCoefClient(float $coefClient): self
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

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->dateFacture;
    }

    public function setDateFacture(\DateTimeInterface $dateFacture): self
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }

    public function getNumRueFacture(): ?int
    {
        return $this->numRueFacture;
    }

    public function setNumRueFacture(int $numRueFacture): self
    {
        $this->numRueFacture = $numRueFacture;

        return $this;
    }

    public function getNomRueFacture(): ?string
    {
        return $this->nomRueFacture;
    }

    public function setNomRueFacture(string $nomRueFacture): self
    {
        $this->nomRueFacture = $nomRueFacture;

        return $this;
    }

    public function getNomVilleFacture(): ?string
    {
        return $this->nomVilleFacture;
    }

    public function setNomVilleFacture(string $nomVilleFacture): self
    {
        $this->nomVilleFacture = $nomVilleFacture;

        return $this;
    }

    public function getCpFacture(): ?string
    {
        return $this->cpFacture;
    }

    public function setCpFacture(string $cpFacture): self
    {
        $this->cpFacture = $cpFacture;

        return $this;
    }

    public function getPaysFacture(): ?string
    {
        return $this->paysFacture;
    }

    public function setPaysFacture(string $paysFacture): self
    {
        $this->paysFacture = $paysFacture;

        return $this;
    }

    public function getNumRueLivraison(): ?int
    {
        return $this->numRueLivraison;
    }

    public function setNumRueLivraison(int $numRueLivraison): self
    {
        $this->numRueLivraison = $numRueLivraison;

        return $this;
    }

    public function getNomRueLivraison(): ?string
    {
        return $this->nomRueLivraison;
    }

    public function setNomRueLivraison(string $nomRueLivraison): self
    {
        $this->nomRueLivraison = $nomRueLivraison;

        return $this;
    }

    public function getNomVilleLivraison(): ?string
    {
        return $this->nomVilleLivraison;
    }

    public function setNomVilleLivraison(string $nomVilleLivraison): self
    {
        $this->nomVilleLivraison = $nomVilleLivraison;

        return $this;
    }

    public function getCpLivraison(): ?string
    {
        return $this->cpLivraison;
    }

    public function setCpLivraison(string $cpLivraison): self
    {
        $this->cpLivraison = $cpLivraison;

        return $this;
    }

    public function getPaysLivraison(): ?string
    {
        return $this->paysLivraison;
    }

    public function setPaysLivraison(string $paysLivraison): self
    {
        $this->paysLivraison = $paysLivraison;

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
    public function getContients(): Collection
    {
        return $this->contients;
    }

    public function addContient(Contient $contient): self
    {
        if (!$this->contients->contains($contient)) {
            $this->contients->add($contient);
            $contient->setCommande($this);
        }

        return $this;
    }

    public function removeContient(Contient $contient): self
    {
        if ($this->contients->removeElement($contient)) {
            // set the owning side to null (unless already changed)
            if ($contient->getCommande() === $this) {
                $contient->setCommande(null);
            }
        }

        return $this;
    }
}
