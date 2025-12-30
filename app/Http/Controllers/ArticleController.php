<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = null;
        $articles = Article::published()->with(['category', 'user']);
        
        // Filter by category if provided
        if ($request->has('category')) {
            $category = Category::findBySlug($request->category);
            if ($category) {
                $articles = $articles->where('category_id', $category->id);
            }
        }
        
        $articles = $articles->orderBy('published_at', 'desc')->paginate(12);
        $categories = Category::getActive();
        
        return view('frontend.articles.index', compact('articles', 'categories', 'category'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $article = Article::findBySlug($slug);
        
        if (!$article) {
            abort(404, 'Artikel tidak ditemukan');
        }
        
        // Increment views
        $article->incrementViews();
        
        // Get related articles from same category
        $relatedArticles = [];
        if ($article->category_id) {
            $relatedArticles = Article::getByCategoryId($article->category_id, 4)
                ->where('id', '!=', $article->id);
        }
        
        return view('frontend.articles.show', compact('article', 'relatedArticles'));
    }
}
