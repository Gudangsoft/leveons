<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $stats = [
            'articles_count' => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'pages_count' => Page::count(),
            'published_pages' => Page::where('status', 'published')->count(),
            'categories_count' => Category::count(),
            'users_count' => User::count(),
        ];
        
        $recentArticles = Article::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        $recentPages = Page::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact('stats', 'recentArticles', 'recentPages'));
    }
    
    /**
     * Clear application cache (not used anymore since we removed caching)
     */
    public function clearCache()
    {
        // Tidak menggunakan cache lagi, tapi tetap clear untuk compatibility
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        
        return redirect()->back()->with('success', 'Cache berhasil dibersihkan! (Aplikasi sudah tidak menggunakan cache)');
    }
}
