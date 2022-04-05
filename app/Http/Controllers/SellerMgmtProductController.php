<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Shop;
use Auth;
use App\ProductCategory;
use App\ProductAttribute;
use App\User;
use App\notification;
use App\PreOrderModel;
use App\ProductVariation;
use App\ratingsModel;
use App\SubOrderItem;
use App\OrderItem;
use App\adminNotifModel;
use App\ProductVars;
use DB;

class SellerMgmtProductController extends Controller
{
    function add_new_product_regular(Request $req){
        $product = new Product();
        $multiple_images = $req->file('images');
        $multiple_images_path = '';

        $multiple_images_counter = 1;
        if($req->hasFile('images')){
            foreach($multiple_images as $single_image){
                $productImage = $single_image;
                $productImageSaveAsName = time() . uniqid() . "-product." . $productImage->getClientOriginalExtension();
                $upload_path = 'storage/products/' . date('FY') . '/';
                $upload_path_url = 'products//' . date('FY') . '//';
                $product_image_url = $upload_path_url . $productImageSaveAsName;
                $success = $productImage->move($upload_path, $productImageSaveAsName);
                $multiple_images_path .= $product_image_url . ',';
                if($multiple_images_counter == 1){
                    $product->cover_img = $product_image_url;
                }
                $multiple_images_counter++;
            }
        }

        $product->secondary_cover_img = $multiple_images_path;
        $product->net_weight = ($req->product_weight_regular != NULL) ? $req->product_weight_regular : '';
        
        if (Auth::user()->role->name == 'admin'){
            $product->shop_id = $req->shop_id;

        }else if (Auth::user()->role->name == 'seller'){
            $product->shop_id = Auth::user()->shop->id;
        }
    
            $product->name = $req->product_name;
            $product->description = $req->product_desc;
            $product->price = ($req->product_price != NULL) ? $req->product_price : '';
            $product->is_sale = $req->is_Sale;
            $product->sold_by = $req->is_sold_by;
            $product->sale_pct_deduction = $req->sale_pct_deduction;
            $product->is_whole_sale = $req->is_wholeSale;
            $product->whole_sale_min_qty = $req->wholesale_min_qty;
            $product->whole_sale_pct_deduction = $req->wholesale_pct_deduct;
            $product->is_pre_sale = $req->is_preSale;
            $product->pre_sale_deadline = $req->pre_sale_deadline;
            $product->stocks = ($req->stocks != NULL) ? $req->stocks : '';
            $product->sold_by = $req->regular_variation_sold_per;
            $multiple_variation_price = $req->variation_price;

            $sold_per_global = $req->regular_variation_sold_per;

        $product->save();
        // detect if product has varaition add section
        if($req->is_have_variation == 'yes'){
            $multiple_variation_counter = 0;
            $multiple_variation_names = $req->variation_name;
            $multiple_variation_price = $req->variation_price;

            // multiple  wholesale price done adding 
            $multiple_variation_price_whole_sale = $req->variation_price_wholesale;
            $multiple_variation_quantity = $req->variation_quantity;
            $multiple_variation_variation_min_qty_wholesale = $req->variation_price_wholesale_quantity;
            
            $multiple_variation_net_weight = $req->variation_net_weight;

            $multiple_variation_sold_per = $req->variation_sold_per;
            foreach($multiple_variation_names as $variation_name){
                // changelog include variation price add product
                $productVariation = new ProductVariation;
                $productVariation->product_id = $product->id;
                $productVariation->variation_name = $variation_name;
                $productVariation->variation_price_per = $multiple_variation_price[$multiple_variation_counter];
                $productVariation->variation_wholesale_price_per = $multiple_variation_price_whole_sale[$multiple_variation_counter];
                $productVariation->variation_min_qty_wholesale = $multiple_variation_variation_min_qty_wholesale[$multiple_variation_counter];
                $productVariation->variation_quantity = $multiple_variation_quantity[$multiple_variation_counter];
                $productVariation->variation_net_weight = $multiple_variation_net_weight[$multiple_variation_counter];
                // variation min qty
         
                // wholesale retail price and note there is a minimum quanitity 
                // 
                // $productVariation->variation_min_qty_wholesale = $multiple_variation_variation_min_qty_wholesale[$multiple_variation_counter];
                // $productVariation->variation_sold_per = $sold_per_global;
                $productVariation->variation_sold_per = $multiple_variation_sold_per[$multiple_variation_counter]; 
         
                $productVariation->save();
                $multiple_variation_counter++;
            }
        }else{
            $productVariation = new ProductVariation;
            $productVariation->product_id = $product->id;
            $productVariation->variation_name = 'Regular';
            // set regular price to regular variation
            // variables in req should not be variation thus change to regular
            $productVariation->variation_price_per = $req->product_price;
            $productVariation->variation_wholesale_price_per = $req->regular_product_wholesale_price;
            $productVariation->variation_min_qty_wholesale = $req->wholesale_regular_product_minimum;
            // quantity refer to stocks
            $productVariation->variation_quantity = $req->stocks;
            $productVariation->variation_net_weight = $req->product_weight_regular;

            $productVariation->save();
        }
     
        $productCategory = new ProductCategory();
        $productCategory->product_id = $product->id;
        $productCategory->category_id = $req->category_id;
        $productCategory->save();

        $adminnotif_ent = new adminNotifModel();
        $adminnotif_ent->action_type = 'Product addition';
        $adminnotif_ent->user_id = Auth::user()->id;
        $adminnotif_ent->action_description = 'Added ' . $product->name . ' to the products list';
        $adminnotif_ent->save();  

        if (Auth::user()->role->name == 'admin') {
            return redirect('/admin/manage_products');
        }else if (Auth::user()->role->name == 'seller') {
            return redirect('/sellerpanel/products');
        }
    }
}
