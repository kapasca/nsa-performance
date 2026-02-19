<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required',
            'slug'    => 'required',
            'excerpt' => 'nullable',
            'content' => 'required',
            'status'  => 'required|in:draft,published',
        ]);

        $data['slug'] = Str::slug($data['title']);

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        } else {
            $data['published_at'] = null;
        }


        Article::create($data);

        return redirect()->route('admin.articles.index');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title'   => 'required',
            'slug'    => 'required',
            'excerpt' => 'nullable',
            'content' => 'required',
            'status'  => 'required|in:draft,published',
        ]);

        $data['slug'] = Str::slug($data['title']);

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        } else {
            $data['published_at'] = null;
        }

        $article->update($data);

        return redirect()->route('admin.articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return back();
    }

    public function togglePublish(Request $request, Article $article)
    {
        if ($article->status === 'published') {
            $article->update([
                'status' => 'draft',
                'published_at' => null,
            ]);
        } else {
            $article->update([
                'status' => 'published',
                'published_at' => now(),
            ]);
        }

        return response()->json([
            'status' => $article->status,
            'published_at' => optional($article->published_at)
                ->format('d M Y H:i'),
        ]);
    }
}
