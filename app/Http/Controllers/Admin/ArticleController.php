<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\EditArticleRequest;
use App\Http\Requests\Admin\CreateArticleRequest;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.articles.create', compact('categories', 'tags'));
    }

    public function show($id)
    {
        // Fetch the article with the given $id and return the article view
        $article = Article::with('category', 'tags')->find($id);
        return view('admin.articles.show', compact('article'));
    }

    public function store(CreateArticleRequest $request)
    {
        $tags = explode(',', $request->tags);

       if ($request->has('image')) {
           $filename = time() . '_' . $request->file('image')->getClientOriginalName();
           $request->file('image')->storeAs('uploads', $filename, 'public');
       }
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $article = auth()->user()->articles()->create([
            'title' => $request->title,
            'image' => $filename ?? null,
            'article' => $request->article,
            'category_id' => $request->category
        ]);

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(EditArticleRequest $request, Article $article)
    {
        $tags = explode(',', $request->tags);

        if ($request->has('image')) {
            Storage::delete('public/uploads/' . $article->image);
            
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('uploads', $filename, 'public');
        }

        $article->update([
            'title' => $request->title,
            'image' => $filename ?? $article->image,
            'article' => $request->article,
            'category_id' => $request->category
        ]);

        $newTags = [];
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            array_push($newTags, $tag->id);
        }
        $article->tags()->sync($newTags);

        return redirect()->route('admin.articles.index');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::delete('public/uploads/' . $article->image);
        }

        $article->tags()->detach();
        $article->delete();

        return redirect()->route('admin.articles.index');
    }
}
