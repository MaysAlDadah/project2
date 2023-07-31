@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($article))
            <div class="card">
                <div class="card-header">{{ $article->title }}</div>

                <div class="card-body">
                    <div class="">
                        @if($article->image)
                            <img src="{{ asset('storage/uploads/' . $article->image) }}" width="100" height="100" class="img-fluid">


                        @else
                            <img src="{{ asset('no_image.jpg') }}" width="100" height="100" class="img-fluid">
                        @endif
                    </div>

                    <div class="my-5">{!! nl2br($article->article) !!}</div>

                    {{-- Show the article's category --}}
                    @if ($article->category)
                        <a href="{{route('admin.categories.index')}}" class="btn btn-outline-secondary">{{ $article->category->name }}</a>
                    @endif
                     <br><br>
                    {{-- Show the article's tags --}}
                    @foreach ($article->tags as $tag)
                        <p>{{ $tag->name }}</p>
                    @endforeach
                </div>
            </div>
        @else
            <p>المقال غير متاح حاليًا.</p>
        @endif
    </div>
@endsection

