<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Shop;
class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryId = request( 'category_id' );
        $categoryName = null;

        if ( isset( $categoryId ) ) {
            $category = Category::find( $categoryId );
            $categoryName = ucfirst( $category->name );
            $products = $category->allProducts();

        } else {
            $products = Product::take( 30 )->get();

        }
        return view( 'product.index', compact( 'products', 'categoryName' ) );
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name','LIKE',"%$query%")->paginate(10);

        return view('product.catalog',compact('products'));
    }

    public function shopCatalog($shopId)
    {
        $shop = Shop::where('id', $shopId)->first();
        $products = Product::where('shop_id', $shopId)->paginate(10);
        return view('shops.shop_homepage',compact('products', 'shop'));
    }

    public function home(){
        $products = Product::take(30)->get();
        $categories = Category::whereNull('parent_id')->get();
        return view('product.index', ['products' => $products]);
    }

    public function show(Product $product)
    {
        if ( ! $this->checkProductImages( $product->id ) ) {
            $layout = 'layouts.front';
            $backUrl = '/';
            $panel_name = 'Not Found';
            return view( '404' )->with( compact( 'layout', 'backUrl', 'panel_name' ) );
        }
        return view('product.show', compact('product'));
    }

    public function presale_show(Product $product){
        return view('product.show_presale', compact('product'));
    }

    public function checkProductImages( $id ) {
        $productImage = ProductImage::where( 'product_id', $id )->get()->count();

        return $productImage > 0 ? true : false;
    }


}
