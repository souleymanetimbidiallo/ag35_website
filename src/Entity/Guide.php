<?php

namespace App\Entity;

use App\Repository\GuideRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: GuideRepository::class)]
#[Vich\Uploadable]
class Guide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'pdf_files', fileNameProperty: 'pdfName')]
    #[Assert\File(maxSize: '15M', mimeTypes: ['application/pdf'], mimeTypesMessage: 'Le guide doit être un fichier PDF.')]
    private ?File $pdfFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $pdfName = null;

    // Non persisté : utilisé par setPdfFile() (évite une propriété dynamique, dépréciée en PHP 8.2)
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setPdfFile(?File $pdfFile = null): void
    {
        $this->pdfFile = $pdfFile;

        if (null !== $pdfFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getPdfFile(): ?File
    {
        return $this->pdfFile;
    }

    public function setPdfName(?string $pdfName): void
    {
        $this->pdfName = $pdfName;
    }

    public function getPdfName(): ?string
    {
        return $this->pdfName;
    }
}
