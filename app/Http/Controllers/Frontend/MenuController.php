<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\HomeHeroSlider;
use App\Models\Insight;
use App\Models\Company;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show($slug)
    { 
        // Validasi untuk slug insight
        if ($slug === 'insight') {
            // Ambil insights yang published
            $insights = Insight::published()
                ->with(['user', 'category'])
                ->orderBy('published_at', 'desc')
                ->paginate(12);
            
            // Ambil insights featured untuk highlight
            $featuredInsights = Insight::published()
                ->featured()
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
            
            // Ambil menu navigation untuk header
            $navigationMenus = Menu::getTreeStructure();
            
            return view('frontend.insight.index', compact('insights', 'featuredInsights', 'navigationMenus'));
        }
        
        // Validasi untuk slug konsultasi-online
        if ($slug === 'konsultasi-online') {
            // Ambil consultants yang published
            $consultants = \App\Models\Consultant::where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Ambil menu navigation untuk header
            $navigationMenus = Menu::getTreeStructure();
            
            // Ambil menu untuk header
            $menu = Menu::where('slug', $slug)->where('status', 'active')->first();
            
            // Ambil company settings
            $company = Company::getSettings();
            
            // Ambil CTA section untuk consultation page
            $ctaSection = \App\Models\CtaSection::getActive('consultation');
            
            return view('frontend.consultants.index', compact('consultants', 'navigationMenus', 'menu', 'company', 'ctaSection'));
        }
        
        // Ambil menu langsung dari database
        $menu = Menu::where('slug', $slug)
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active')
                    ->orderBy('sort_order');
            }])
            ->first();

        if (!$menu) {
            abort(404, 'Halaman tidak ditemukan');
        }

        // Ambil breadcrumb
        $breadcrumbs = $this->getBreadcrumbs($menu);
        
        // Ambil menu navigation untuk header
        $navigationMenus = Menu::getTreeStructure();

        return view('frontend.menu.show', compact('menu', 'breadcrumbs', 'navigationMenus'));
    }

    public function index()
    {
        // Homepage - tampilkan menu utama dan konten home
        $homeMenu = Menu::where('slug', 'home')->first();

        $navigationMenus = Menu::getTreeStructure();

        // Ambil beberapa menu utama untuk ditampilkan di homepage
        $serviceMenus = Menu::where('slug', 'service')
            ->with(['children' => function ($query) {
                $query->where('status', 'active')
                    ->orderBy('sort_order')
                    ->limit(6);
            }])
            ->first();

        // Ambil featured menus untuk services showcase (langsung dari database)
        $featuredMenus = Menu::where('is_featured', true)
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        // Ambil hero sliders untuk homepage
        $heroSliders = HomeHeroSlider::active()->ordered()->get();

        // Ambil CTA section yang aktif untuk home page
        $ctaSection = \App\Models\CtaSection::getActive('home');

        return view('frontend.home', compact('homeMenu', 'navigationMenus', 'serviceMenus', 'heroSliders', 'featuredMenus', 'ctaSection'));
    }

    private function getBreadcrumbs($menu)
    {
        $breadcrumbs = [];
        $current = $menu;

        while ($current) {
            array_unshift($breadcrumbs, [
                'title' => $current->title,
                'slug' => $current->slug,
                'url' => $current->slug === 'home' ? '/' : '/menu/' . $current->slug
            ]);
            
            $current = $current->parent;
        }

        return $breadcrumbs;
    }

    public function showInsight($slug)
    {
        // Ambil insight berdasarkan slug
        $insight = Insight::where('slug', $slug)
            ->published()
            ->with(['user', 'category'])
            ->first();

        if (!$insight) {
            abort(404, 'Insight tidak ditemukan');
        }

        // Increment views
        $insight->incrementViews();

        // Ambil insights terkait (dari kategori yang sama atau random)
        $relatedInsights = Insight::published()
            ->where('id', '!=', $insight->id)
            ->when($insight->category_id, function ($query) use ($insight) {
                $query->where('category_id', $insight->category_id);
            })
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Jika tidak ada related insights dari kategori yang sama, ambil insights terbaru
        if ($relatedInsights->count() < 3) {
            $relatedInsights = Insight::published()
                ->where('id', '!=', $insight->id)
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        }

        // Ambil menu navigation untuk header
        $navigationMenus = Menu::getTreeStructure();

        return view('frontend.insight.show', compact('insight', 'relatedInsights', 'navigationMenus'));
    }
}
