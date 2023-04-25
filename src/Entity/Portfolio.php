<?php

namespace App\Entity;

use App\Repository\PortfolioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortfolioRepository::class)]
class Portfolio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 100)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: PortfolioTag::class, inversedBy: 'portfolios')]
    private Collection $portfolioTags;

    #[ORM\ManyToOne(inversedBy: 'portfolios')]
    private ?PortfolioClass $portfolioClass = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    public function __construct()
    {
        $this->portfolioTags = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, PortfolioTag>
     */
    public function getPortfolioTags(): Collection
    {
        return $this->portfolioTags;
    }

    public function addPortfolioTag(PortfolioTag $portfolioTag): self
    {
        if (!$this->portfolioTags->contains($portfolioTag)) {
            $this->portfolioTags->add($portfolioTag);
        }

        return $this;
    }

    public function removePortfolioTag(PortfolioTag $portfolioTag): self
    {
        $this->portfolioTags->removeElement($portfolioTag);

        return $this;
    }

    public function getPortfolioClass(): ?PortfolioClass
    {
        return $this->portfolioClass;
    }

    public function setPortfolioClass(?PortfolioClass $portfolioClass): self
    {
        $this->portfolioClass = $portfolioClass;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    
}
