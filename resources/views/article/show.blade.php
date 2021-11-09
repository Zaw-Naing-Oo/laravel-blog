@extends('layouts.app')

@section("title") {{ $article->title }} @endsection

@section("head")
    <style>
        .description{
            white-space: pre-line;
        }
    </style>
    @stop

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article list</a></li>
        <li class="breadcrumb-item active" aria-current="page">Article Detail</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        {{ $article->title }}
                    </h4>
                    <div class="mt-3 mb-2 text-primary">
                        <span class="small mr-1 font-weight-bold">
                                <i class="feather-user"></i>
                                {{ $article->user->name }}
                        </span>
                        <span class="small mr-1 font-weight-bold">
                                <i class="feather-layers"></i>
                                {{ $article->category->title }}
                        </span>
                        <span class="small mr-1 font-weight-bold">
                                <i class="feather-calendar"></i>
                                {{ $article->created_at->format("d / m / Y") }}
                        </span>
                        <span class="small font-weight-bold">
                                <i class="feather-clock"></i>
                                {{ $article->created_at->format("h : i A") }}
                        </span>
                    </div>
                    <p class="text-black-50 description">
                        {{ $article->description }}
                    </p>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <a href="{{ route('article.edit',$article->id) }}">
                                <button class="btn btn-outline-primary">
                                    Edit
                                </button>
                            </a>
                            <form action="{{ route('article.destroy',[$article->id]) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger" onclick="return confirm('Are U sure to delete this article')">
                                    Delete
                                </button>
                            </form>
                        </div>
                        <p class="mb-0">{{ $article->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
