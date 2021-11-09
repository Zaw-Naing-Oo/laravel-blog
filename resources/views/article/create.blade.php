@extends('layouts.app')

@section("title") Create Article @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Article</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        <i class="feather-plus-circle"></i>
                        Create Article
                    </h4>
                    <form action="{{ route('article.store') }}" id="createArticle" method="post">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="form-group mb-0">
                        <label>Select Category</label>
                        <select name="category" form="createArticle" id="" class="custom-select custom-select-lg @error('category_id')  is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option> // take back old data
                            @endforeach
                        </select>
                        @error('category')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="form-group">

                        <div class="form-group">
                            <label>Article Title</label>
                            <input type="text" class="form-control form-control-lg @error('title')  is-invalid @enderror" name="title" form="createArticle" value="{{ old('title') }}">
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Article Description</label>
                            <textarea type="text" rows="6" class="form-control form-control-lg @error('description')  is-invalid @enderror" form="createArticle" name="description">{{ old('description') }}</textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="form-group mb-0">
                        <button class="btn btn-primary btn-lg w-100" form="createArticle">Create Article</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
