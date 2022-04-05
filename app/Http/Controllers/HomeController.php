<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Shop;
use Illuminate\Http\Request;
use Auth;
use App\agcoins;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
   //  $this->middleware('auth', 'verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::latest()->get();
        $presale_products = Product::where('is_pre_sale', '1')->latest()->get();
        $categories = Category::whereNull('parent_id')->get();
        $shops = Shop::where('is_active', '1')->latest()->get();
        return view('home', ['allProducts' => $products,'categories'=>$categories, 'shops'=>$shops, 'total_ag_coins'=>agcoins::getAgCoins(), 'pre_sale_products' => $presale_products]);
    }

    public function contact()
    {
        return view('contact');
    }
}
