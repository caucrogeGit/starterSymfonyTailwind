<?php

namespace App\Entity\Post;

use DateTimeImmutable;
use App\Entity\Post\Post;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Post\ThumbnailRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ThumbnailRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Thumbnail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'post_thumbnail', fileNameProperty: 'imageName', size: 'imageSize')]
    /* Utilise le fichier config\packages\vich_uploader.yaml pour le mapping */
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $imageName = null;

    #[ORM\Column(type: 'integer')]
    private ?int $imageSize = null;

    #[ORM\Column(type:'datetime_immutable', length:255, unique:true)]
    private DateTimeImmutable $updatedAt; 

    #[ORM\Column(type:'datetime_immutable', length:255, unique:true)]
    private DateTimeImmutable $createdAt; 

    // Relation
    #[ORM\OneToOne(mappedBy: 'thumbnail', targetEntity: Post::class, cascade: ['persist', 'remove'])]
    private Post $post; 


    // Constructeur
    public function __construct()
    {
        $this->updatedAt = new DateTimeImmutable();
        $this->createdAt = new DateTimeImmutable();
    }  

    // Méthodes évenementielles
    #[ORM\PreUpdate]
    public function preUpdate()
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    // Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

   /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getUpdatedAt():DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt):self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt():DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt):self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost($post): self
    {
        $this->post = $post;

        return $this;
    }
}
