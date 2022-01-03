<?php

namespace App\Http\Controllers;

use App\Entities\Post;
use App\Http\Requests\Post\Destroy as DestroyRequest;
use App\Http\Requests\Post\Show as ShowRequest;
use App\Http\Requests\Post\Store as StoreRequest;
use App\Http\Requests\Post\Update as UpdateRequest;
use App\Transformers\Post\Collection as PostCollection;
use App\Transformers\Post\Resource as PostResource;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Response;

class PostController extends Controller
{
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function index(): PostCollection
    {
        $posts = $this->em->getRepository(Post::class)->findAll();

        return PostCollection::make($posts);
    }

    public function store(StoreRequest $request): Response
    {
        $author = new Post();
        $author->setName($request->get('name'));
        $this->em->persist($author);
        $this->em->flush();

        return response('Created successfully', 201);
    }
//
    public function show(ShowRequest $request): PostResource
    {
        $author = $this->em->find(Post::class, id: $request->json('id'));
        $this->em->flush();

        return PostResource::make($author);
    }
//
//    public function update(UpdateRequest $request): PostResource
//    {
//        $author = $this->em->find(Post::class, id: $request->json('id'));
//        $author->setName($request->get('name'));
//        $this->em->persist($author);
//        $this->em->flush();
//
//        return PostResource::make($author);
//    }
//
//    public function destroy(DestroyRequest $request): Response
//    {
//        $author = $this->em->find(Post::class, $request->json('id'));
//        $this->em->remove($author);
//        $this->em->flush();
//
//        return response('Deleted successfully', 200);
//    }
}
