<?php

namespace App\Entity;

use App\Repository\MesImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: MesImageRepository::class)]
#[Vich\Uploadable]
class MesImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'ag35_images', fileNameProperty: 'imageName')]
    private ?File $imageFile1 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName1 = null;

    #[Vich\UploadableField(mapping: 'ag35_images', fileNameProperty: 'imageName')]
    private ?File $imageFile2 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName2 = null;

    #[Vich\UploadableField(mapping: 'ag35_images', fileNameProperty: 'imageName')]
    private ?File $imageFile3 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName3 = null;

    #[Vich\UploadableField(mapping: 'ag35_images', fileNameProperty: 'imageName')]
    private ?File $imageFile4 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName4 = null;

    #[Vich\UploadableField(mapping: 'ag35_images', fileNameProperty: 'imageName')]
    private ?File $imageFile5 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName5 = null;

    #[Vich\UploadableField(mapping: 'ag35_images', fileNameProperty: 'imageName')]
    private ?File $imageFile6 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName6 = null;

    #[Vich\UploadableField(mapping: 'ag35_images', fileNameProperty: 'imageName')]
    private ?File $imageFile7 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName7 = null;

    #[Vich\UploadableField(mapping: 'ag35_images', fileNameProperty: 'imageName')]
    private ?File $imageFile8 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName8 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setImageFile1(?File $imageFile1 = null): void
    {
        $this->imageFile1 = $imageFile1;

        if (null !== $imageFile1) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile1(): ?File
    {
        return $this->imageFile1;
    }

    public function setImageName1(?string $imageName1): void
    {
        $this->imageName1 = $imageName1;
    }

    public function getImageName1(): ?string
    {
        return $this->imageName1;
    }

    public function setImageFile2(?File $imageFile2 = null): void
    {
        $this->imageFile2 = $imageFile2;

        if (null !== $imageFile2) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile2(): ?File
    {
        return $this->imageFile2;
    }

    public function setImageName2(?string $imageName2): void
    {
        $this->imageName2 = $imageName2;
    }

    public function getImageName2(): ?string
    {
        return $this->imageName2;
    }

    public function setImageFile3(?File $imageFile3 = null): void
    {
        $this->imageFile3 = $imageFile3;

        if (null !== $imageFile3) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile3(): ?File
    {
        return $this->imageFile3;
    }

    public function setImageName3(?string $imageName3): void
    {
        $this->imageName3 = $imageName3;
    }

    public function getImageName3(): ?string
    {
        return $this->imageName3;
    }

    public function setImageFile4(?File $imageFile4 = null): void
    {
        $this->imageFile4 = $imageFile4;

        if (null !== $imageFile4) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile4(): ?File
    {
        return $this->imageFile4;
    }

    public function setImageName4(?string $imageName4): void
    {
        $this->imageName4 = $imageName4;
    }

    public function getImageName4(): ?string
    {
        return $this->imageName4;
    }

    public function setImageFile5(?File $imageFile5 = null): void
    {
        $this->imageFile5 = $imageFile5;

        if (null !== $imageFile5) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile5(): ?File
    {
        return $this->imageFile5;
    }

    public function setImageName5(?string $imageName5): void
    {
        $this->imageName5 = $imageName5;
    }

    public function getImageName5(): ?string
    {
        return $this->imageName5;
    }

    public function setImageFile6(?File $imageFile6 = null): void
    {
        $this->imageFile6 = $imageFile6;

        if (null !== $imageFile6) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile6(): ?File
    {
        return $this->imageFile6;
    }

    public function setImageName(?string $imageName6): void
    {
        $this->imageName6 = $imageName6;
    }

    public function getImageName6(): ?string
    {
        return $this->imageName6;
    }

    public function setImageFile7(?File $imageFile7 = null): void
    {
        $this->imageFile7 = $imageFile7;

        if (null !== $imageFile7) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile7(): ?File
    {
        return $this->imageFile7;
    }

    public function setImageName7(?string $imageName7): void
    {
        $this->imageName7 = $imageName7;
    }

    public function getImageName7(): ?string
    {
        return $this->imageName7;
    }

    public function setImageFile8(?File $imageFile8 = null): void
    {
        $this->imageFile8 = $imageFile8;

        if (null !== $imageFile8) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile8(): ?File
    {
        return $this->imageFile8;
    }

    public function setImageName8(?string $imageName8): void
    {
        $this->imageName8 = $imageName8;
    }

    public function getImageName8(): ?string
    {
        return $this->imageName8;
    }
}
