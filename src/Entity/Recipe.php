<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $extrainto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adjustements;

    /**
     * @ORM\ManyToOne(targetEntity=CourseType::class, inversedBy="recipes")
     */
    private $coursetype;

    /**
     * @ORM\ManyToOne(targetEntity=Source::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $source;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, inversedBy="recipes")
     */
    private $ingredient;

    /**
     * @ORM\OneToMany(targetEntity=CookingHistory::class, mappedBy="recipe")
     */
    private $cookingHistory;

    /**
     * @ORM\OneToMany(targetEntity=Evaluation::class, mappedBy="recipe")
     */
    private $evaluation;

    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
        $this->cookingHistory = new ArrayCollection();
        $this->evaluation = new ArrayCollection();
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

    public function getExtrainto(): ?string
    {
        return $this->extrainto;
    }

    public function setExtrainto(string $extrainto): self
    {
        $this->extrainto = $extrainto;

        return $this;
    }

    public function getAdjustements(): ?string
    {
        return $this->adjustements;
    }

    public function setAdjustements(string $adjustements): self
    {
        $this->adjustements = $adjustements;

        return $this;
    }

    public function getCoursetype(): ?CourseType
    {
        return $this->coursetype;
    }

    public function setCoursetype(?CourseType $coursetype): self
    {
        $this->coursetype = $coursetype;

        return $this;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->ingredient->removeElement($ingredient);

        return $this;
    }

    /**
     * @return Collection|CookingHistory[]
     */
    public function getCookingHistory(): Collection
    {
        return $this->cookingHistory;
    }

    public function addCookingHistory(CookingHistory $cookingHistory): self
    {
        if (!$this->cookingHistory->contains($cookingHistory)) {
            $this->cookingHistory[] = $cookingHistory;
            $cookingHistory->setRecipe($this);
        }

        return $this;
    }

    public function removeCookingHistory(CookingHistory $cookingHistory): self
    {
        if ($this->cookingHistory->removeElement($cookingHistory)) {
            // set the owning side to null (unless already changed)
            if ($cookingHistory->getRecipe() === $this) {
                $cookingHistory->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluation(): Collection
    {
        return $this->evaluation;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluation->contains($evaluation)) {
            $this->evaluation[] = $evaluation;
            $evaluation->setRecipe($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluation->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getRecipe() === $this) {
                $evaluation->setRecipe(null);
            }
        }

        return $this;
    }

    public function calcAverageEval() {
        $i = 0;
        $totalevaluation = 0;

        foreach ($this->evaluation as $valeur){
            $i++;
            $totalevaluation += $valeur->getStar();
        }
        if ($i != 0) {
            return $totalevaluation = $totalevaluation/$i;
        }
        else {
            return "No note, add one";
        }
    }
}
