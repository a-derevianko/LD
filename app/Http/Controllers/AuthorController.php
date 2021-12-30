<?php

namespace App\Http\Controllers;

use App\Entities\Author;
use App\Http\Requests\Author\Destroy as DestroyRequest;
use App\Http\Requests\Author\Show as ShowRequest;
use App\Http\Requests\Author\Store as StoreRequest;
use App\Http\Requests\Author\Update as UpdateRequest;
use App\Transformers\Author\Collection as AuthorCollection;
use App\Transformers\Author\Resource as AuthorResource;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function index(): AuthorCollection
    {
        $authors = $this->em->getRepository(Author::class)->findAll();

        return AuthorCollection::make($authors);
    }

    public function store(StoreRequest $request): Response
    {
        $author = new Author();
        $author->setName($request->get('name'));
        $this->em->persist($author);
        $this->em->flush();

        return response('Created successfully', 201);
    }

    public function show(ShowRequest $request): AuthorResource
    {
        $author = $this->em->find(Author::class, id: $request->json('id'));
        $this->em->flush();

        return AuthorResource::make($author);
    }

    public function update(UpdateRequest $request): AuthorResource
    {
        $author = $this->em->find(Author::class, id: $request->json('id'));
        $author->setName($request->get('name'));
        $this->em->persist($author);
        $this->em->flush();

        return AuthorResource::make($author);
    }

    public function destroy(DestroyRequest $request): Response
    {
        $author = $this->em->find(Author::class, $request->json('id'));
        $this->em->remove($author);
        $this->em->flush();

        return response('Deleted successfully', 200);
    }
}
