<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(RecipeRepository $recipeRepository): Response
    {
        $allRecipes = $recipeRepository->findAll();
        $i = array_rand($allRecipes, 1);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'ramdomRecipe' => $allRecipes[$i],
            'recipe_list' => $allRecipes,
        ]);
    }
}
