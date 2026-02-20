<?php

namespace App\Http\Controllers;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $sliderProducts = Product::where('slider', true)->latest()->limit(6)->get();
        $products = Product::latest()->limit(8)->get();
        return view('front.index', compact('sliderProducts', 'products'));
    }

//    public function welcome()
//    {
//        return view('welcome');
//    }
    public function index()
    {
        return view('admin.dashboard');
    }
}

