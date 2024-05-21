<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity('title', message:"Ce nom d'article existe déjà")]
#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('articles:read')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Vous devez indiquer un titre')]
    #[Groups('articles:read')]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:'Vous devez indiquer une description')]
    private ?string $content = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Groups('articles:read')]
    private ?\DateTimeImmutable $publishedAt = null;

    #[ORM\PrePersist]
    public function setPublishedAtValue(): void
    {
        $this->publishedAt = new \DateTimeImmutable();
    }

    #[ORM\ManyToOne(inversedBy: 'article')]
    #[Assert\NotBlank(message:'Vous devez indiquer une catégorie')]
    #[Groups('articles:read')]
    private ?Category $category = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Vous devez ajouter une image de présentation")]
    #[Groups('articles:read')]
    private ?string $main_image = null;

    /**
     * @var Collection<int, ArticleImage>
     */
    #[ORM\OneToMany(targetEntity: ArticleImage::class, mappedBy: 'article')]
    private Collection $articleImages;

    public function __construct()
    {
        $this->articleImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeImmutable $publishedAt): static
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getMainImage(): ?string
    {
        return $this->main_image;
    }

    public function setMainImage(string $main_image): static
    {
        $this->main_image = $main_image;

        return $this;
    }

    /**
     * @return Collection<int, ArticleImage>
     */
    public function getArticleImages(): Collection
    {
        return $this->articleImages;
    }

    public function addArticleImage(ArticleImage $articleImage): static
    {
        if (!$this->articleImages->contains($articleImage)) {
            $this->articleImages->add($articleImage);
            $articleImage->setArticle($this);
        }

        return $this;
    }

    public function removeArticleImage(ArticleImage $articleImage): static
    {
        if ($this->articleImages->removeElement($articleImage)) {
            // set the owning side to null (unless already changed)
            if ($articleImage->getArticle() === $this) {
                $articleImage->setArticle(null);
            }
        }

        return $this;
    }
}
