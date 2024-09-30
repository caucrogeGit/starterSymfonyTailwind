<?php

namespace App\Repository\Post;

use App\Entity\Post\Post;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    // Constructeur
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    // Méthodes
    /**
     * Get published posts
     *
     * @return array
     */
    public function findPublished() : array
    {
        return $this->createQueryBuilder('post')
                    ->where('post.state Like :state')
                    ->setParameter('state', 'STATE_PUBLISHED')
                    ->orderBy('post.createdAt', 'DESC')
                    ->getQuery()
                    ->getResult();
    }

}
