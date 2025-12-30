<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Page;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get featured content with caching
        $featuredArticles = Article::getFeatured(3);
        $featuredPages = Page::getFeatured();
        $categories = Category::getActive();
        $recentArticles = Article::getPublished(6);
        
        return view('frontend.home', compact(
            'featuredArticles', 
            'featuredPages', 
            'categories', 
            'recentArticles'
        ));
    }
}
