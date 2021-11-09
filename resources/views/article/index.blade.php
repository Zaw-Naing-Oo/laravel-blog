@extends('layouts.app')

@section("title") Article List @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Article List</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="">
                        <i class="feather-list"></i>
                        Article List
                    </h4>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <div class="">
                            <a href="{{ route('article.create') }}" class="btn btn-primary btn-lg mr-2">
                                <i class="feather-plus-circle"></i>
                                Create Article
                            </a>
                            @isset(request()->search)
                                <a href="{{ route('article.index') }}" class="btn btn-dark btn-lg mr-2">
                                    <i class="feather-list"></i>
                                    All Article
                                </a>
                                <span class="h5">Search :  {{ request()->search }}</span>
                                @endisset
                        </div>
                        <form action="{{ route('article.index') }}" class="mb-3" method="get">
                            <div class="form-inline">
                                <input type="text" placeholder="Search Article" name="search" class="form-control mr-2" value="{{ request()->search }}" required>
                                <button class="btn btn-primary">
                                    <i class="feather-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    @if(session('message'))
                        <p class="alert alert-success">{{ session('message') }}</p>
                    @endif

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Article</th>
                            <th>Category</th>
                            <th>Owner</th>
                            <th>Control</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>
                                    <span class="font-weight-bold">{{ Str::words($article->title ,5) }}</span>
                                    <br>
                                    <small>{{ Str::words($article->description,8)  }}</small>
                                </td>
                                <td>{{ $article->category->title }}</td>
                                <td>{{ $article->user->name }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('article.show',$article->id) }}">
                                        <button class="btn btn-outline-success">
                                            Show
                                        </button>
                                    </a>
                                    <a href="{{ route('article.edit',$article->id) }}">
                                        <button class="btn btn-outline-primary">
                                            Edit
                                        </button>
                                    </a>
                                    <form action="{{ route('article.destroy',[$article->id,'page'=>request()->page]) }}" method="post" class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger" onclick="return confirm('Are U sure to delete this article ')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <td>
                            <span class="small">
                                <i class="feather-calendar"></i>
                                {{ $article->created_at->format("d / m / Y") }}
                            </span>
                                    <br>
                                    <span class="small">
                                <i class="feather-clock"></i>
                                {{ $article->created_at->format("h : i A") }}
                            </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There is no record</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center mb-0">
                        {{ $articles->appends(request()->all())->links() }}
                        <p class="font-weight-bold">Total : {{ $articles->total() }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
