<?php

namespace App\Http\Controllers;

use App\Entities\Author;
use App\Entities\Post;
use App\Http\Requests\Post\Destroy as DestroyRequest;
use App\Http\Requests\Post\Show as ShowRequest;
use App\Http\Requests\Post\Store as StoreRequest;
use App\Http\Requests\Post\Update as UpdateRequest;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Transformers\Post\Collection as PostCollection;
use App\Transformers\Post\Resource as PostResource;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
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
        $posts = $this->repository->getAllPosts();

        return PostCollection::make($posts);
    }

    public function store(StoreRequest $request): Response
    {
        $validated = $request->safe()->only(['author_id', 'title', 'text']);
        $author = $this->authorRepository->getAuthorById($validated['author_id']);
        $post = new Post();
        $post->setAuthor($author);
        $post->setTitle($validated['title']);
        $post->setText($validated['text']);
        $this->repository->store($post);

        return response('Created successfully', 201);
    }

    public function show(ShowRequest $request): PostResource
    {
        $validated = $request->safe()->only(['id']);
        $post = $this->repository->getPostById($validated['id']);

        return PostResource::make($post);
    }

    public function update(UpdateRequest $request): PostResource
    {
        $validated = $request->safe()->only(['author_id', 'title', 'text']);
        $author = $this->authorRepository->getAuthorById($validated['author_id']);
        $post->setName($request->get('name'));
        $this->repository->update($post);

        return PostResource::make($post);
    }
//
//    public function destroy(DestroyRequest $request): Response
//    {
//        $post = $this->repository->find(Post::class, $request->json('id'));
//        $this->repository->remove($post);
//        $this->repository->flush();
//
//        return response('Deleted successfully', 200);
//    }
}
