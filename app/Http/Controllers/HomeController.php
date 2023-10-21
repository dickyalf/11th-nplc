<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        return view('user.home', [
            'title' => 'Home',
            'latestProducts' => $latestProducts,
            'slider' => Slider::get(),
        ]);
    }
}
