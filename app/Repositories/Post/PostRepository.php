<?php

namespace App\Repositories\Post;

use App\Entities\Post;
use App\Interfaces\Repositories\PostRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
//use Doctrine\Persistence\ObjectRepository;

class PostRepository extends EntityRepository implements PostRepositoryInterface
{
    private EntityManagerInterface $em;
//    private ObjectRepository|EntityRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct($this->em, $this->em->getClassMetadata(Post::class));
//        $this->repository = $this->em->getRepository(Post::class);
    }

    public function getAllPosts(): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('Post', 'Author')
            ->from(Post::class, 'Post')
            ->leftJoin('Post.author', 'Author');
        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getPostById(int|string $id): Post
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('Post', 'Author')
            ->from(Post::class, 'Post')
            ->leftJoin('Post.author', 'Author')
            ->where('Post.id = :id')
            ->setParameter('id', $id);
        $query = $qb->getQuery();

        return $query->getSingleResult();
    }

    public function store(Post $post): Post
    {
        $this->em->persist($post);
        $this->em->flush();

        return $post;
    }

    public function update(Post $post): Post
    {
        $this->em->persist($post);
        $this->em->flush();

        return $post;
    }

    public function destroy(Post $post): Post
    {
        $this->em->remove($post);
        $this->em->flush();

        return $post;
    }
}