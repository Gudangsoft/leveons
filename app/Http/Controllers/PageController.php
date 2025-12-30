<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $page = Page::findBySlug($slug);
        
        if (!$page) {
            abort(404, 'Halaman tidak ditemukan');
        }
        
        return view('frontend.pages.show', compact('page'));
    }
}
