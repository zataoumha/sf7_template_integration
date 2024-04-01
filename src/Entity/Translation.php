<?php

namespace App\Entity;

use App\Repository\TranslationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TranslationRepository::class)]
class Translation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $locale = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $translationKey = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $translationValue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $translationPage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): static
    {
        $this->locale = $locale;

        return $this;
    }

    public function getTranslationKey(): ?string
    {
        return $this->translationKey;
    }

    public function setTranslationKey(string $translationKey): static
    {
        $this->translationKey = $translationKey;

        return $this;
    }

    public function getTranslationValue(): ?string
    {
        return $this->translationValue;
    }

    public function setTranslationValue(?string $translationValue): static
    {
        $this->translationValue = $translationValue;

        return $this;
    }

    public function getTranslationPage(): ?string
    {
        return $this->translationPage;
    }

    public function setTranslationPage(?string $translationPage): static
    {
        $this->translationPage = $translationPage;

        return $this;
    }
}
