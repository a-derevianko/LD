<?php

namespace App\Http\Controllers;

use App\Entities\Author;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function index()
    {
        $authors = $this->em->getRepository(Author::class)->findAll();

        return response(var_export($authors));
    }

    public function store(Request $request)
    {
        $author = new Author();
        $author->setName($request->get('name'));
        $this->em->persist($author);
        $this->em->flush();

        return response(status: 201);
    }

    public function show($id)
    {
        $author = $this->em->find(Author::class, $id);

        return response(var_export($author));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
