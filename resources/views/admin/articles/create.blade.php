@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Create Article
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="required" for="title">Title</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                               name="title" id="title" value="{{ old('title') }}" required>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="image">Image</label>
                        <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="file"
                               name="image" id="image" value="{{ old('image') }}">
                        @if($errors->has('image'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="tags">Tags</label>
                        <input class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" type="text"
                               name="tags" id="tags" value="{{ old('tags') }}" required>
                        @if($errors->has('tags'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tags') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="category">Category</label>
                        <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category"
                                id="category" required>
                            <option value="0">--- SELECT CATEGORY ---</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->has('category'))
                            <div class="invalid-feedback">
                                {{ $errors->first('category') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="article">Article</label>
                        <textarea class="form-control {{ $errors->has('article') ? 'is-invalid' : '' }}" name="article"
                                  id="article">{{ old('article') }}</textarea>
                        @if($errors->has('article'))
                            <div class="invalid-feedback">
                                {{ $errors->first('article') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
