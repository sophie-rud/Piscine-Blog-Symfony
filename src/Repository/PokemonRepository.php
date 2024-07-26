<?php

namespace App\Repository;

use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pokemon>
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    // On ajoute manuellement une fonction dans le repository de notre table pokemon
    public function findLikeTitle($search)
    { // On appelle la méthode createQueryBuilder
        $queryBuilder = $this->createQueryBuilder('pokemon');

        // On crée une requête sql avec la commande select
        $query = $queryBuilder->select('pokemon')
            // where = condition. Récupère tous les pokemons à condition que le titre du pokemon contienne les caractères de la recherche
            // Sécurisation de la recherche utilisateur :search. (: évite les injections sql).
            ->where('pokemon.title LIKE :search')
            // Paramètres : On cherche les titres des pokemon qui comportent, qq part dans le titre, les caractères entrés par l'utilisateur
            ->setParameter('search', '%'.$search.'%')
            // On exécute la requête
            ->getQuery();

        // La requête nous retourne un tableau de résultats, qu'on stocke dans la variable $pokemons.
        $pokemons = $query->getArrayResult();

        return $pokemons;
    }

//    /**
//     * @return Pokemon[] Returns an array of Pokemon objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pokemon
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
