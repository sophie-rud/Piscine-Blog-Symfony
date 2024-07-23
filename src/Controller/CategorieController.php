<?php

// Création d'un namespace, qui indique le chemin de la classe courante
namespace App\Controller;

// On appelle le namespace des classes qu'on utilise, Symfony fera le require vers ces classes
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


// Nouvelle classe CategorieController qui hérite de la classe AbstractController (elle hérite de toutes les propriétés et méthodes, exceptées celles en 'private').
class CategorieController extends AbstractController {

    // Annotation qui permet de créer une route, c-à-d une nouvelle page sur notre appli quand la méthode qui suit est appelée.
    #[Route('/categorie', name: 'categorie')]
    public function listCategories ()
    {
        $categories = [
            'Red', 'Green', 'Blue', 'Yellow', 'Gold', 'Silver', 'Crystal'
        ];

        // Appel de la méthode renderView pour l'affichage twig
        $html = $this->renderView('page/listCategories.html.twig', [
            'categories' => $categories
        ]);

        // return une nouvelle instance de la classe Response
        return new Response($html, 200);

    }

}