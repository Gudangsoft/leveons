<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::getWithArticleCounts();
        
        return view('frontend.categories.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $category = Category::findBySlug($slug);
        
        if (!$category) {
            abort(404, 'Kategori tidak ditemukan');
        }
        
        $articles = Article::getByCategoryId($category->id);
        $articles = collect($articles)->paginate(12);
        
        return view('frontend.categories.show', compact('category', 'articles'));
    }
}
