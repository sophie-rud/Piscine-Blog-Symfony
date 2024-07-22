<?php

// Création d'un namespace, qui indique le chemin de la classe courante
namespace App\Controller;

// On appelle le namespace des classes qu'on utilise, Symfony fera le require vers ces classes
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Le nom de la classe doit être EXACTEMENT le même que le nom du fichier !
// Extends de la class AbstractController : IndexController va hériter de ses propriétés et méthodes (hormis celle en private)
class IndexController extends AbstractController {

    //#[Route est une Annotation. Elle enrichit la méthode qui suit.
    // Elle permet de créer une route, c-à-d une nouvelle page sur notre appli. Quand l'url est appelée, la méthode placée dessous est exécutée.
    #[Route('/', name: 'home')]
    public function index() {
        // la méthode render vient de l'AbstractController
        return $this->render('page/index.html.twig');
      // var_dump('hello');die;
    }
}