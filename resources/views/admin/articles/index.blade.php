@extends('layouts.app')
@section('content')
    <div class="container">
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.articles.create') }}">
                    Add articles
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i> Articles list</div>
            <div class="card-body">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($articles  as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->category->name }}</td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('admin.articles.edit', $article->id) }}">
                                    Edit
                                </a>

                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $articles->links() }}

            </div>
        </div>
    </div>
@endsection
