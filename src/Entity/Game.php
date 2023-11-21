<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ApiResource(graphQlOperations: [
    new Query(),
    new QueryCollection(paginationType: 'page', filters: ['game.name', 'game.platform', 'game.studios']),
    new Mutation(name: 'create'),
    new Mutation(name: 'update'),
    new DeleteMutation(name: 'delete'),
])]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'partial', 'platform' => 'partial', 'studios.name' => 'partial'])]

class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $genres = [];

    #[ORM\Column(nullable: true)]
    private ?int $publicationDate = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $platform = [];

    #[ORM\ManyToMany(targetEntity: Editor::class, inversedBy: 'games')]
    private Collection $editors;

    #[ORM\ManyToMany(targetEntity: Studio::class, inversedBy: 'games')]
    private Collection $studios;

    public function __construct()
    {
        $this->editors = new ArrayCollection();
        $this->studios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function setGenres(array $genres): static
    {
        $this->genres = $genres;

        return $this;
    }

    public function getPublicationDate(): ?int
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?int $publicationDate): static
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getPlatform(): array
    {
        return $this->platform;
    }

    public function setPlatform(array $platform): static
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * @return Collection<int, Editor>
     */
    public function getEditors(): Collection
    {
        return $this->editors;
    }

    public function addEditor(Editor $editor): static
    {
        if (!$this->editors->contains($editor)) {
            $this->editors->add($editor);
        }

        return $this;
    }

    public function removeEditor(Editor $editor): static
    {
        $this->editors->removeElement($editor);

        return $this;
    }

    /**
     * @return Collection<int, Studio>
     */
    public function getStudios(): Collection
    {
        return $this->studios;
    }

    public function addStudio(Studio $studio): static
    {
        if (!$this->studios->contains($studio)) {
            $this->studios->add($studio);
        }

        return $this;
    }

    public function removeStudio(Studio $studio): static
    {
        $this->studios->removeElement($studio);

        return $this;
    }
}
