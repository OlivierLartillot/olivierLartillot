<?php

namespace App\Entity;

use App\Repository\RealisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealisationRepository::class)]
class Realisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumbnail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $full_image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(nullable: true)]
    private ?bool $online = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeOfWork = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $country = null;

    #[ORM\ManyToMany(targetEntity: TechnicalStack::class, inversedBy: 'realisations')]
    private Collection $stack;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteLink = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $technicalContent = null;

    #[ORM\OneToMany(mappedBy: 'realisation', targetEntity: RealisationGallerie::class)]
    private Collection $imagesGallerie;

    public function __construct()
    {
        $this->stack = new ArrayCollection();
        $this->imagesGallerie = new ArrayCollection();
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

    public function getSubTitle(): ?string
    {
        return $this->subTitle;
    }

    public function setSubTitle(?string $subTitle): self
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getFullImage(): ?string
    {
        return $this->full_image;
    }

    public function setFullImage(?string $full_image): self
    {
        $this->full_image = $full_image;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(?bool $online): self
    {
        $this->online = $online;

        return $this;
    }

    public function getTypeOfWork(): ?string
    {
        return $this->typeOfWork;
    }

    public function setTypeOfWork(?string $typeOfWork): self
    {
        $this->typeOfWork = $typeOfWork;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, TechnicalStack>
     */
    public function getStack(): Collection
    {
        return $this->stack;
    }

    public function addStack(TechnicalStack $stack): self
    {
        if (!$this->stack->contains($stack)) {
            $this->stack->add($stack);
        }

        return $this;
    }

    public function removeStack(TechnicalStack $stack): self
    {
        $this->stack->removeElement($stack);

        return $this;
    }

    public function getSiteLink(): ?string
    {
        return $this->siteLink;
    }

    public function setSiteLink(?string $siteLink): self
    {
        $this->siteLink = $siteLink;

        return $this;
    }

    public function getTechnicalContent(): ?string
    {
        return $this->technicalContent;
    }

    public function setTechnicalContent(?string $technicalContent): self
    {
        $this->technicalContent = $technicalContent;

        return $this;
    }

    /**
     * @return Collection<int, RealisationGallerie>
     */
    public function getImagesGallerie(): Collection
    {
        return $this->imagesGallerie;
    }

    public function addImagesGallerie(RealisationGallerie $imagesGallerie): self
    {
        if (!$this->imagesGallerie->contains($imagesGallerie)) {
            $this->imagesGallerie->add($imagesGallerie);
            $imagesGallerie->setRealisation($this);
        }

        return $this;
    }

    public function removeImagesGallerie(RealisationGallerie $imagesGallerie): self
    {
        if ($this->imagesGallerie->removeElement($imagesGallerie)) {
            // set the owning side to null (unless already changed)
            if ($imagesGallerie->getRealisation() === $this) {
                $imagesGallerie->setRealisation(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }
}
