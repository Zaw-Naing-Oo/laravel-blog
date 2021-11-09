<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->where("title","LIKE","%$search%")->orwhere("description","LIKE","%$search%");
        })->with(['user','category'])->latest("id")->paginate(8);
//        return $articles;
        return view('welcome',compact('articles'));
    }

    public function detail($id){
        $article = Article::find($id);
        return view('blog.detail',compact('article'));
    }

    public function baseOnCategory($id){
        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->where("title","LIKE","%$search%")->orwhere("description","LIKE","%$search%");
        })->where("category_id",$id)->with(['user','category'])->latest("id")->paginate(8);
//        return $articles;
        return view('welcome',compact('articles'));
    }

    public function baseOnUser($id){
        $articles = Article::where("user_id",$id)->when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->where("title","LIKE","%$search%")->orwhere("description","LIKE","%$search%");
        })->with(['user','category'])->latest("id")->paginate(8);
//        return $articles;
        return view('welcome',compact('articles'));
    }

    public function baseOnDate($date){
        $articles = Article::where("created_at",$date)->when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->where("title","LIKE","%$search%")->orwhere("description","LIKE","%$search%");
        })->with(['user','category'])->latest("id")->paginate(8);
//        return $articles;
        return view('welcome',compact('articles'));
    }
}
