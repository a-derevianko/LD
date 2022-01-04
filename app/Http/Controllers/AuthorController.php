<?php

namespace App\Http\Controllers;

use App\Entities\Author;
use App\Http\Requests\Author\Destroy as DestroyRequest;
use App\Http\Requests\Author\Show as ShowRequest;
use App\Http\Requests\Author\Store as StoreRequest;
use App\Http\Requests\Author\Update as UpdateRequest;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use App\Transformers\Author\Collection as AuthorCollection;
use App\Transformers\Author\Resource as AuthorResource;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    private AuthorRepositoryInterface $repository;

    public function __construct(AuthorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(): AuthorCollection
    {
        $authors = $this->repository->getAllAuthors();

        return AuthorCollection::make($authors);
    }

    public function store(StoreRequest $request): Response
    {
        $validated = $request->safe()->only(['name']);
        $author = new Author();
        $author->setName($validated['name']);
        $this->repository->store($author);

        return response('Created successfully', 201);
    }

    public function show(ShowRequest $request): AuthorResource
    {
        $validated = $request->safe()->only(['id']);
        $author = $this->repository->getAuthorById(id: $validated['id']);

        return AuthorResource::make($author);
    }

    public function update(UpdateRequest $request): AuthorResource
    {
        $validated = $request->safe()->only(['id', 'name']);
        $author = $this->repository->getAuthorById(id: $validated['id']);
        $author->setName($validated['name']);
        $this->repository->update($author);

        return AuthorResource::make($author);
    }

    public function destroy(DestroyRequest $request): Response
    {
        $validated = $request->safe()->only(['id']);
        $author = $this->repository->getAuthorById(id: $validated['id']);
        $this->repository->destroy($author);

        return response('Deleted successfully', 200);
    }
}
