<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  /**
   * List latest published articles
   */
  public function index()
  {
    $articles = Article::where('status', 'published')
      ->orderByDesc('published_at')
      ->paginate(6);

    return view('articles.index', compact('articles'));
  }

  /**
   * Show single article
   */
  public function show(string $slug)
  {
    $article = Article::where('slug', $slug)
      ->where('status', 'published')
      ->firstOrFail();

    return view('admin.articles.show', compact('article'));
  }

  /**
   * API – latest articles (for homepage / ajax)
   */
  public function latest(Request $request)
  {
    $limit  = (int) $request->get('limit', 3);
    $offset = (int) $request->get('offset', 0);

    $query = Article::where('status', 'published')
      ->latest('published_at');

    return response()->json([
      'data'  => $query->skip($offset)->take($limit)->get(),
      'total' => $query->count(),
    ]);
  }
}
