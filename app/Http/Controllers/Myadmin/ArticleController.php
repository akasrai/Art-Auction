<?php

namespace App\Http\Controllers\Myadmin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article as ArticleResource; // importing Article model as ArticleResource 

class ArticleController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get articles

        $articles = Article::orderBy('created_at','desc')->paginate(5); // to get all data use get() instead of paginate()

        //return collection of articles as resource
        return ArticleResource::collection($articles);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;

        $article->id = $request->input('article_id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if($article->save()){

            return new ArticleResource($article);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get single article using id
        $article = Article::findOrFail($id);

        //Return the single article as resource
        return new ArticleResource($article);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get article using id
        $article = Article::findOrFail($id);

        if($article->delete()){

            return new ArticleResource($article);    
        }
        
    }
}
