<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $all = Article::all();
//        foreach ($all as $a){
////            $a->slug = Str::slug($a->title)."-".uniqid();
//            $a->excerpt = Str::slug($a->description)."-".uniqid();
//            $a->update();
//        }

        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->where("title","LIKE","%$search%")->orwhere("description","LIKE","%$search%");
        })->with(['user','category'])->latest("id")->paginate(8);
        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "category" => "required|exists:App\Category,id", // You can use => exists:categories,id
            "title"=>  "required|min:5|max:100",
             "description" => "required|min:5|max:1000",
        ]);

        $article = new Article();
        $article->category_id = $request->category;
        $article->title = $request->title;
        $article->slug = Str::slug($request->title)."-".uniqid();
        $article->description = $request->description;
        $article->excerpt = Str::words($request->description ,35);
        $article->user_id = Auth::id();
        $article->save();

        return redirect()->route('article.index')->with('message','Article Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            "category" => "required|exists:App\Category,id", // You can use => exists:categories,id
            "title"=>  "required|min:5|max:100",
            "description" => "required|min:5|max:1000",
        ]);

        $article->category_id = $request->category;
        if($article->title != $request->title){
            $article->slug = Str::slug($request->title)."-".uniqid();
        }
        $article->title = $request->title;
        $article->description = $request->description;
        $article->excerpt = Str::words($request->description ,35);
        $article->user_id = Auth::id();
        $article->update();

        return redirect()->route('article.index')->with('message','Article Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('article.index',['page'=>request()->page])->with('message','Article Deleted');

    }

    public function apiIndex(){
        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->where("title","LIKE","%$search%")->orwhere("description","LIKE","%$search%");
        })->with(['user','category'])->latest("id")->paginate(8);

        return $articles;
    }
}
