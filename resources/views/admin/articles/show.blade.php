@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $article->title }}</div>

            <div class="card-body">
                <div class="">
                    @if($article->image)
                        <img src="{{ asset('uploads/' . $article->image) }}" width="100" height="100"
                             class="img-fluid">
                    @else
                        <img src="{{ asset('no_image.jpg') }}" width="100" height="100" class="img-fluid">
                    @endif
                </div>

                <div class="my-5">{!! nl2br($article->article) !!}</div>

                @foreach ($article->categories as $category)
                    <a href="#" class="btn btn-outline-secondary">{{ $category->name }}</a>
                @endforeach

                @foreach ($article->tags as $tag)
                    <p>{{ $tag->name }}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
