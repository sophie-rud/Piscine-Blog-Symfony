<?php

declare(strict_types=1);


// Création d'un namespace, qui indique le chemin de la classe courante
namespace App\Controller;

// On appelle le namespace des classes Symfony qu'on utilise, Symfony fera le require vers ces classes
use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



// Nouvelle classe CategorieController qui hérite de la classe AbstractController (elle hérite de toutes les propriétés et méthodes, exceptées celles en 'private').
class PokemonController extends AbstractController {

    private array $pokemons;

    public function __construct()
    {
        $this->pokemons = [
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

    }



    // Annotation : crée une nouvelle page dès que la fonction listPokemons est appelée.
    #[Route('list-pokemons/', name: 'list_pokemons')]
    public function listPokemons() {


        return $this->render('page/listPokemons.html.twig',
            ['pokemons' => $this->pokemons]);
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
    #[Route('show-pokemon/{idPokemon}', name: 'show_pokemon')]
    public function showPokemon($idPokemon): Response {

        // On récupère toutes les super-globales et symfony les stocke dans la variable $request
        // Dans $request est stockée une instance de la classe Request.  |   :: est une méthode (statique)
        // En d'autres termes : Injection de dépendance : on demande à Symfony de créer une instance de la classe Request dans la variable $request.
        // $request = Request::createFromGlobals();

        /* $request = new Request($_GET, etc);
        // est comme $request = new Request($_GET, etc). Si on utilse cette ligne il faut mettre Request $request en paramètre de la fonction : public function showPokemon(Request $request)


        // On récupère l'id dans d'url, on stocke cette donnée dans une variable
        $idPokemon = $request->query->get('id'); */


        $pokemonFound = null;

        // On fait un foreach sur le tableau pokemon pour trouver, dans le tableau $pokemon, le pokemon correspondant à l'id' recherché.
        foreach ($this->pokemons as $pokemon) {

           if ($pokemon['id'] === (int)$idPokemon) {  /* OU if ($pokemon['id'] == 'idPokemon') */
               /* Si le pokemon est trouvé, il est enregistré dans la variable $pokemonFound */
               $pokemonFound = $pokemon;

            }
        }

        // On retourne le fichier twig qui affiche le pokemon correspondant a l'id recherché
        return $this->render('page/showPokemon.html.twig', [
            'pokemon' => $pokemonFound
        ]);

    }


    #[Route('pokemons-bdd/', name: 'pokemons_bdd')]
    public function listPokemonsBdd(PokemonRepository $pokemonRepository): Response
    {
       $pokemonsBdd = $pokemonRepository->findAll();

       return $this->render('page/listPokemonsBDD.html.twig', [
           'pokemonsBdd' => $pokemonsBdd
       ]);

    }



    // Route est une classe
    // /{id} : wild card
    #[Route('/pokemon-db/{id}', name: 'pokemon_by_id_db')]
    // Response : typage (pas obligatoire, mais conseillé)
    public function showPokemonById(int $id, PokemonRepository $pokemonRepository): Response {

        $pokemon = $pokemonRepository->find($id);

        return $this->render('page/showPokemonDb.html.twig', [
            'pokemon' => $pokemon
        ]);
    }

    #[Route('/pokemon-db-search', name: 'search_pokemon')]
    // On passe en paramètres de la fonction les classes Request et PokemonRepository, Symfony va instancier ces classes
    public function searchPokemon(Request $request, PokemonRepository $pokemonRepository):Response {

        $pokemonFound = null;

        if ($request->request->has('title')) {

            // On stocke dans la variable $titleSearched le paramètre récupéré dans le formulaire
            $titleSearched = $request->request->get('title');
            // findOneBy existe déjà dans tous les repository
            $pokemonFound = $pokemonRepository->findOneBy(['title' => $titleSearched]);

                // Si aucun pokemon n'a été trouvé, on affiche une page erreur 404
                if(!$pokemonFound) {
                    $html = $this->renderView('page/404.html.twig');
                    return new Response($html, 404);
                }
        }


         // Si pokemon trouvé, on affiche la page du pokemon trouvé
         return $this->render('page/pokemonSearch.html.twig', [
             'pokemon' => $pokemonFound
         ]);

    }





}

