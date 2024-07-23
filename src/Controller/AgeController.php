<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class AgeController extends AbstractController {

// Annotation : crée une nouvelle page dès que la fonction checkAge est appelée.
    #[Route('/checked', name: 'checked')]
    public function checkAge() {
        // On stocke les super-globales dans la variable $request
        $request = Request::createFromGlobals();

        // Si la requête ne comporte pas le paramètre 'age' dans l'url, afficher la page du formulaire à compléter.
        if (!$request->query->has('age')) {
            return $this->render('page/poker_form.html.twig');
        // sinon on stocke la donnée temporaire 'age' dans la variable $age
        } else {
            $age = $request->get('age');
        }

// On récupère un paramètre d'url : l'âge, on stocke cette donnée dans une variable
        $age = $request->query->get('age');

        // si age>= 18 on affiche la page de validation
        if ($age >= 18) {
            return $this->render('page/welcomePokemon.html.twig');
        } else {
            // sinon on affiche la page avec message d'erreur
            return $this->render('page/notPassed.html.twig');
        }
    }
}

