<?php

namespace App\Http\Controllers;

use App\Entities\Post;
use App\Http\Requests\Post\Destroy as DestroyRequest;
use App\Http\Requests\Post\Show as ShowRequest;
use App\Http\Requests\Post\Store as StoreRequest;
use App\Http\Requests\Post\Update as UpdateRequest;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Transformers\Post\Collection as PostCollection;
use App\Transformers\Post\Resource as PostResource;
use Illuminate\Http\Response;

class PostController extends Controller
{
    private PostRepositoryInterface $repository;
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(PostRepositoryInterface $repository, AuthorRepositoryInterface $authorRepository)
    {
        $this->repository = $repository;
        $this->authorRepository = $authorRepository;
    }

    public function index(): PostCollection
    {
        $posts = $this->repository->getAll();

        return PostCollection::make($posts);
    }

    public function store(StoreRequest $request): Response
    {
        $validated = $request->safe()->only(['author_id', 'title', 'text']);
        $author = $this->authorRepository->getById($validated['author_id']);
        $post = new Post();
        $post->setAuthor($author);
        $post->setTitle($validated['title']);
        $post->setText($validated['text']);
        $this->repository->save($post);

        return response('Created successfully', 201);
    }

    public function show(ShowRequest $request): PostResource
    {
        $validated = $request->safe()->only(['id']);
        $post = $this->repository->getById($validated['id']);

        return PostResource::make($post);
    }

    public function update(UpdateRequest $request): PostResource
    {
        $validated = $request->safe()->only(['id', 'author_id', 'title', 'text']);
        $author = $this->authorRepository->getById($validated['author_id']);
        $post = $this->repository->getById($validated['id']);
        $post->setAuthor($author);
        $post->setTitle($validated['title']);
        $post->setText($validated['text']);
        $this->repository->save($post);

        return PostResource::make($post);
    }

    public function destroy(DestroyRequest $request): Response
    {
        $validated = $request->safe()->only(['id']);
        $post = $this->repository->getById($validated['id']);
        $this->repository->destroy($post);

        return response('Deleted successfully', 200);
    }
}
