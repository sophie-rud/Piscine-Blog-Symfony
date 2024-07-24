<?php


// Création d'un namespace, qui indique le chemin de la classe courante
namespace App\Controller;

// On appelle le namespace des classes Symfony qu'on utilise, Symfony fera le require vers ces classes
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Nouvelle classe CategorieController qui hérite de la classe AbstractController (elle hérite de toutes les propriétés et méthodes, exceptées celles en 'private').
class PokemonController extends AbstractController {

    // Annotation : crée une nouvelle page dès que la fonction listPokemons est appelée.
    #[Route('list-pokemons/', name: 'list_pokemons')]
    public function listPokemons() {

        $pokemons = [
            [
                'id' => 1,
                'title' => 'Carapuce',
                'content' => 'Pokemon eau',
                'isPublished' => true
            ],
            [
                'id' => 2,
                'title' => 'Salamèche',
                'content' => 'Pokemon feu',
                'isPublished' => true
            ],
            [
                'id' => 3,
                'title' => 'Bulbizarre',
                'content' => 'Pokemon plante',
                'isPublished' => true
            ],
            [
                'id' => 4,
                'title' => 'Pikachu',
                'content' => 'Pokemon electrique',
                'isPublished' => true
            ],
            [
                'id' => 5,
                'title' => 'Rattata',
                'content' => 'Pokemon normal',
                'isPublished' => false
            ],
            [
                'id' => 6,
                'title' => 'Roucool',
                'content' => 'Pokemon vol',
                'isPublished' => true
            ],
            [
                'id' => 7,
                'title' => 'Aspicot',
                'content' => 'Pokemon insecte',
                'isPublished' => false
            ],
            [
                'id' => 8,
                'title' => 'Nosferapti',
                'content' => 'Pokemon poison',
                'isPublished' => false
            ],
            [
                'id' => 9,
                'title' => 'Mewtwo',
                'content' => 'Pokemon psy',
                'isPublished' => true
            ],
            [
                'id' => 10,
                'title' => 'Ronflex',
                'content' => 'Pokemon normal',
                'isPublished' => false
            ]
        ];


        return $this->render('page/listPokemons.html.twig',
            ['pokemons' => $pokemons]);
    }



    // Annotation qui permet de créer une route, c-à-d une nouvelle page sur notre appli quand la méthode qui suit est appelée.
    #[Route('/categorie', name: 'categorie')]
    public function listCategories ()
    {
        $categories = [
            'Red', 'Green', 'Blue', 'Yellow', 'Gold', 'Silver', 'Crystal'
        ];

        // Appel de la méthode renderView pour l'affichage twig
        // $this-> fait référence à une instance de classe. renderView est une méthode de la classe AbstractController.
        $html = $this->renderView('page/listCategories.html.twig', [
            'categories' => $categories
        ]);

        // return une nouvelle instance de la classe Response
        return new Response($html, 200);

    }



    // Annotation : crée une nouvelle page dès que la fonction showPokemon est appelée.
    #[Route('show-pokemon', name: 'show_pokemon')]
    public function showPokemon() {

        // On récupère toutes les super-globales et symfony les stocke dans la variable $request
        // Dans $request est stockée une instance de la classe Request.  |   :: est une méthode (statique)
        $request = Request::createFromGlobals();

        // On récupère l'id dans d'url, on stocke cette donnée dans une variable
        $idPokemon = $request->query->get('id');


        $pokemons = [
            [
                'id' => 1,
                'title' => 'Carapuce',
                'content' => 'Pokemon eau',
                'isPublished' => true
            ],
            [
                'id' => 2,
                'title' => 'Salamèche',
                'content' => 'Pokemon feu',
                'isPublished' => true
            ],
            [
                'id' => 3,
                'title' => 'Bulbizarre',
                'content' => 'Pokemon plante',
                'isPublished' => true
            ],
            [
                'id' => 4,
                'title' => 'Pikachu',
                'content' => 'Pokemon electrique',
                'isPublished' => true
            ],
            [
                'id' => 5,
                'title' => 'Rattata',
                'content' => 'Pokemon normal',
                'isPublished' => false
            ],
            [
                'id' => 6,
                'title' => 'Roucool',
                'content' => 'Pokemon vol',
                'isPublished' => true
            ],
            [
                'id' => 7,
                'title' => 'Aspicot',
                'content' => 'Pokemon insecte',
                'isPublished' => false
            ],
            [
                'id' => 8,
                'title' => 'Nosferapti',
                'content' => 'Pokemon poison',
                'isPublished' => false
            ],
            [
                'id' => 9,
                'title' => 'Mewtwo',
                'content' => 'Pokemon psy',
                'isPublished' => true
            ],
            [
                'id' => 10,
                'title' => 'Ronflex',
                'content' => 'Pokemon normal',
                'isPublished' => false
            ]
        ];



        $pokemonFound = null;

        // On fait un foreach sur le tableau pokemon pour trouver, dans le tableau $pokemon, le pokemon correspondant à l'id' recherché.
        foreach ($pokemons as $pokemon) {

           if ($pokemon['id'] === (int)$idPokemon) {  /* OU if ($pokemon['id'] == 'idPokemon') */
               $pokemonFound = $pokemon;

            }
        }

        // On retourne le fichier twig qui affiche le pokemon correspondant a l'id recherché
        return $this->render('page/show-pokemon.html.twig', [
            'pokemon' => $pokemonFound
        ]);

    }
}

