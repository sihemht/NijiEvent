<?php

namespace App\Entity;

use App\Entity\Authors;
use App\Repository\BooksRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Workflow\Annotation\WorkflowMetadata;

#[ORM\Entity(repositoryClass: BooksRepository::class)]
class Books
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $saga = null;

    #[ORM\Column(nullable: true)]
    private ?int $number = null;

    #[ORM\Column(nullable: true)]
    private ?int $number_of_page = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $month_of_purchase = null;

    #[ORM\Column(nullable: true)]
    private ?int $used_id = null;


    #[ORM\Column(nullable: true)]
    #[Assert\Range(
        notInRangeMessage: "The rating must be between {{ min }} and {{ max }}",
        min: 0,
        max: 5,
    )]
    private ?int $rating = null;


    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $authors = [];


    private ?string $authorsText = null;


    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $genresText = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $genres = [];

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Choice(choices: ['to_read', 'reading', 'finished', 'abandoned'], message: 'Choose a valid status.')]
    private ?string $readingStatus = 'to_read';

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageCover = null;

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

    public function getSaga(): ?string
    {
        return $this->saga;
    }

    public function setSaga(?string $saga): static
    {
        $this->saga = $saga;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }


    public function setNumber(?int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getNumberOfPage(): ?int
    {
        return $this->number_of_page;
    }

    public function setNumberOfPage(?int $number_of_page): static
    {
        $this->number_of_page = $number_of_page;

        return $this;
    }

    public function getMonthOfPurchase(): ?\DateTimeInterface
    {
        return $this->month_of_purchase;
    }

    public function setMonthOfPurchase(?\DateTimeInterface $month_of_purchase): static
    {
        $this->month_of_purchase = $month_of_purchase;

        return $this;
    }

    public function getUsedId(): ?int
    {
        return $this->used_id;
    }

    public function setUsedId(?int $used_id): static
    {
        $this->used_id = $used_id;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    public function getAuthorsText(): ?string
    {
        return $this->authorsText;
    }

    public function setAuthorsText(?string $authorsText): self
    {
        $this->authorsText = $authorsText;
        return $this;
    }

    public function getAuthors(): ?array
    {
        return $this->authors;
    }

    public function setAuthors(?array $authors): self
    {
        $this->authors = $authors;
        return $this;
    }

    public function getGenresText(): ?string
    {
        return $this->genresText;
    }

    public function setGenresText(?string $genresText): self
    {
        $this->genresText = $genresText;
        return $this;
    }

    public function getGenres(): ?array
    {
        return $this->genres;
    }

    public function setGenres(?array $genres): self
    {
        $this->genres = $genres;
        return $this;
    }

    public function getReadingStatus(): ?string
    {
        return $this->readingStatus;
    }

    public function setReadingStatus(?string $readingStatus): self
    {
        $this->readingStatus = $readingStatus;
        return $this;
    }

    public function getImageCover(): ?string
    {
        return $this->imageCover;
    }

    public function setImageCover(?string $imageCover): self
    {
        $this->imageCover = $imageCover;

        return $this;
    }
}
