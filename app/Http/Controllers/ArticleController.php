<?php

namespace App\Http\Controllers;

use App\Entities\Article;
use App\Http\Requests\Article\Destroy as DestroyRequest;
use App\Http\Requests\Article\Show as ShowRequest;
use App\Http\Requests\Article\Store as StoreRequest;
use App\Http\Requests\Article\Update as UpdateRequest;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use App\Interfaces\Repositories\ArticleRepositoryInterface;
use App\Transformers\Article\Collection as ArticleCollection;
use App\Transformers\Article\Resource as ArticleResource;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    private ArticleRepositoryInterface $repository;
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(ArticleRepositoryInterface $repository, AuthorRepositoryInterface $authorRepository)
    {
        $this->repository = $repository;
        $this->authorRepository = $authorRepository;
    }

    public function index(): ArticleCollection
    {
        $articles = $this->repository->getAll();

        return ArticleCollection::make($articles);
    }

    public function store(StoreRequest $request): Response
    {
        $validated = $request->safe()->only(['author_id', 'title', 'text']);
        $author = $this->authorRepository->getById($validated['author_id']);
        $article = new Article();
        $article->setAuthor($author);
        $article->setTitle($validated['title']);
        $article->setText($validated['text']);
        $this->repository->save($article);

        return response('Created successfully', 201);
    }

    public function show(ShowRequest $request): ArticleResource
    {
        $validated = $request->safe()->only(['id']);
        $article = $this->repository->getById($validated['id']);

        return ArticleResource::make($article);
    }

    public function update(UpdateRequest $request): ArticleResource
    {
        $validated = $request->safe()->only(['id', 'author_id', 'title', 'text']);
        $author = $this->authorRepository->getById($validated['author_id']);
        $article = $this->repository->getById($validated['id']);
        $article->setAuthor($author);
        $article->setTitle($validated['title']);
        $article->setText($validated['text']);
        $this->repository->save($article);

        return ArticleResource::make($article);
    }

    public function destroy(DestroyRequest $request): Response
    {
        $validated = $request->safe()->only(['id']);
        $article = $this->repository->getById($validated['id']);
        $this->repository->destroy($article);

        return response('Deleted successfully', 200);
    }
}
