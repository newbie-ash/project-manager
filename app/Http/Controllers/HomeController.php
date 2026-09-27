<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch 4 featured products to display on the landing page
        $featuredProducts = Product::latest()->take(4)->get();
        
        return Inertia::render('Welcome', [
            'featuredProducts' => $featuredProducts
        ]);
    }
}
