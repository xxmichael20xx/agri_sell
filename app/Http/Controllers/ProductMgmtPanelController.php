<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Shop;
use Illuminate\Support\Facades\Auth;
use App\ProductCategory;
use App\ProductVariation;
use App\adminNotifModel;
use App\ProductImage;
use DB;

class ProductMgmtPanelController extends Controller
{

    // product mgmt panel controller for both admin and seller
    function index() {
        if ( Auth::user()->role->name == 'admin' ) {
            $products = Product::latest()->get();
            $view = 'admin.products.index';

        } else if ( Auth::user()->role->name == 'seller' ) {

            $products = Product::where( 'shop_id', Auth::user()->shop->id )->get();

            if ( isset( $_GET['with'] ) && $_GET['with'] == 'deleted' ) {
                $products = Product::onlyTrashed()->where( 'shop_id', Auth::user()->shop->id )->get();
            }

            foreach ( $products as $index => $_ ) {
                if ( $_->deleted_at !== NULL && $_->is_confirmed_deleted == TRUE ) {
                    $products->forget( $index );
                }
            }

            $view = 'sellerPanel.products.index';

        } else {
            $products = Product::latest()->get();
            $view = 'admin.products.index';
        }

        return view( $view )->with('panel_name', 'products')->with(compact('products'));
    }

    function edit( $product_id ) {
        $product = Product::with('prod_variation')->where( 'id', $product_id )->first();
        $shops = Shop::all();
        $panel_name = ( $product ) ? "Update " . $product->name : '';
        
        if ( Auth::user()->role->name == 'admin' ) {
            return view('admin.products.edit')->with('panel_name', 'products')->with(compact('product', 'shops'));

        } else if ( Auth::user()->role->name == 'seller' ) {
            if ( $product->product_user_id !== Auth::user()->id ) {
                $layout = 'sellerPanel.front';
                $backUrl = '/sellerpanel/products';
                $panel_name = 'Unauthorized';
                return view( '401' )->with( compact( 'layout', 'backUrl', 'panel_name' ) );
            }
            return view( 'sellerPanel.products_variation_rev.edit' )->with( compact( 'product', 'shops', 'panel_name' ) );
        }
    }

    function show( $product_id ) {
        $product = Product::withTrashed()->where( 'id', $product_id )->first();

        if ( $product->deleted_at ) return redirect( "/sellerpanel/restore/{$product_id}" );

        if (Auth::user()->role->name == 'admin') {
            return view('admin.products.show')->with('panel_name', 'products')->with(compact('product'));
        } else if (Auth::user()->role->name == 'seller') {
            return view('sellerPanel.products.show')->with('panel_name', 'products')->with(compact('product'));
        }
    }


    function delete($product_id) {
        $product = Product::where('id', $product_id)->delete();
        // $productCategory = ProductCategory::where('product_id', $product_id)->delete();
        // $ratingsTbl = ratingsModel::where('rateable_id', $product_id)->delete();
        // $productRatings = DB::table('ratings')->where('rateable_id', $product_id)->delete();
        // $productVariation = ProductVariation::where('product_id', $product_id)->delete();
        // $productPreOrders = PreOrderModel::where('product_id', $product_id)->delete();
        // $sub_order_items = SubOrderItem::where('product_id', $product_id)->delete();
        // $order_item = OrderItem::where('product_id', $product_id)->delete();
        return back();
    }

    function add_new_display_form_regular() {
        $shops = Shop::all();
        if (Auth::user()->role->name == 'admin') {
            return view('admin.products.add_new')->with('panel_name', 'product')->with('shops', $shops);
        } else if (Auth::user()->role->name == 'seller') {
            return view('sellerPanel.products.add_new_product_regular_default')->with('panel_name', 'product');
        }
    }

    function add_new_display_form_product_variation() {
        $shops = Shop::all();
        if (Auth::user()->role->name == 'admin') {
            return view('admin.products.add_new_product_variation_default')->with('panel_name', 'product')->with('shops', $shops);
        } else if (Auth::user()->role->name == 'seller') {
            return view('sellerPanel.products.add_new_product_variation_default')->with('panel_name', 'product');
        }
    }

    // form function changelog march 20 2022 variation
    // form function changelog march 22 variation multi
    function add_new_display_form_variation(Request $request) {
        $product = new Product();
        $product->name = $request->product_name;
        $product->description = $request->product_desc;
        $product->is_sale = $request->is_Sale;
        $product->is_pre_sale = $request->is_preSale;
        $product->sale_pct_deduction = ($request->is_Sale == 1) ? $request->sale_pct_deduction : '0';
        $product->shop_id = Auth::user()->shop->id;
        
        $product->is_whole_sale = $request->is_wholeSale;
        $product->product_user_id = $this->userId() ?? NULL; // add the user id of the current user

        $multiple_images = $request->file('images');
        $multiple_images_path = '';
        $multiple_images_counter = 1;
        
        if ($request->hasFile('images')) {
            foreach($multiple_images as $single_image) {
                $productImage = $single_image;
                $productImageSaveAsName = time() . uniqid() . "-product." . $productImage->getClientOriginalExtension();
                $upload_path = 'storage/products/' . date('FY') . '/';
                $upload_path_url = 'products//' . date('FY') . '//';
                $product_image_url = $upload_path_url . $productImageSaveAsName;
                $success = $productImage->move($upload_path, $productImageSaveAsName);
                $multiple_images_path .= $product_image_url . ',';
                if ($multiple_images_counter == 1) {
                    $product->cover_img = $product_image_url;
                }
                $multiple_images_counter++;
            }
        }

        $product->secondary_cover_img = $multiple_images_path;
        if (Auth::user()->role->name == 'admin') {
            $product->shop_id = $request->shop_id;
        } else if (Auth::user()->role->name == 'seller') {
            $product->shop_id = Auth::user()->shop->id;
        }
           
        $product->save();

        $multiple_variation_counter = 0;
        $multiple_variation_names = $request->variation_name;
        $multiple_variation_price = $request->retail_price;
        $multiple_variation_price_whole_sale = $request->wholesale_price;
        // multiple  wholesale price done adding 
        $multiple_variation_quantity = $request->variation_quantity;

        $multiple_variation_min_qty_wholesale = $request->wholesale_min_qty;
        $multiple_variation_net_weight = $request->standard_net_weight;
        $multiple_variation_net_weight_unit = $request->standard_net_weight_unit;
        $multiple_variation_is_wholesale = $request->multiple_variation_is_wholesale;
        $multiple_variation_stocks = $request->stocks;
        $multiple_variation_sold_per = $request->variation_sold_per;


        foreach ($multiple_variation_names as $variation_name) {      
            $productVariation = new ProductVariation;

            $productVariation->product_id = $product->id;
            $productVariation->variation_name = $multiple_variation_names[$multiple_variation_counter];
            $productVariation->variation_min_qty_wholesale = $multiple_variation_min_qty_wholesale[$multiple_variation_counter];
            $productVariation->variation_quantity = $multiple_variation_stocks[$multiple_variation_counter];
            $productVariation->variation_net_weight = $multiple_variation_net_weight[$multiple_variation_counter];
            $productVariation->variation_net_weight_unit = $multiple_variation_net_weight_unit[$multiple_variation_counter];
          

            if ($multiple_variation_price_whole_sale[$multiple_variation_counter] == NULL || $multiple_variation_min_qty_wholesale[$multiple_variation_counter] == NULL || $multiple_variation_price_whole_sale[$multiple_variation_counter] == '' || $multiple_variation_min_qty_wholesale[$multiple_variation_counter] == '' ) {
                // retail only
                $productVariation->is_variation_wholesale = 'no';
            } else {
                // with wholesale
                // thus retail with wholesale will be reflected
                $productVariation->variation_price_per = $multiple_variation_price[$multiple_variation_counter];
                $productVariation->variation_wholesale_price_per = $multiple_variation_price_whole_sale[$multiple_variation_counter];
                $productVariation->variation_min_qty_wholesale = $multiple_variation_min_qty_wholesale[$multiple_variation_counter];
                $productVariation->is_variation_wholesale = 'yes';    
                $productVariation->is_variation_wholesale_only = 'no';
            }

            // wholesale only entity
            if ( $multiple_variation_price[$multiple_variation_counter] == NULL ||  $multiple_variation_price[$multiple_variation_counter] == '') {
                $productVariation->is_variation_wholesale = 'yes';
                $productVariation->is_variation_wholesale_only = 'yes';
                $productVariation->variation_price_per = $multiple_variation_price_whole_sale[$multiple_variation_counter];
                $productVariation->variation_wholesale_price_per =  $multiple_variation_price_whole_sale[$multiple_variation_counter];                $productVariation->variation_min_qty_wholesale = $multiple_variation_min_qty_wholesale[$multiple_variation_counter]; 
            } else {
                // retail only
                $productVariation->variation_price_per =  $multiple_variation_price[$multiple_variation_counter];
            }

            $multiple_variation_counter++;

            $productVariation->save();
        }

        $productCategory = new ProductCategory();
        $productCategory->product_id = $product->id;
        $productCategory->category_id = $request->category_id;
        $productCategory->save();

        $adminnotif_ent = new adminNotifModel();
        $adminnotif_ent->action_type = 'Product addition';
        $adminnotif_ent->user_id = Auth::user()->id;
        $adminnotif_ent->action_description = 'Added ' . $product->name . ' to the products list';
        $adminnotif_ent->save();  

        $productCategory = new ProductCategory();
        $productCategory->product_id = $product->id;
        $productCategory->category_id = $request->category_id;
        $productCategory->save();
        
        if (Auth::user()->role->name == 'admin') {
            return redirect('/admin/manage_products');
        } else if (Auth::user()->role->name == 'seller') {
            return redirect('/sellerpanel/products');
        }
    }

    // form function changelog march 20 2022 regular 
    // changed function march 22 2022 regular
    function save_new_display_form_regular( Request $request ) {
        $this->validate( $request, [
            'product_name' => 'required',
            'images' => 'required',
            'category_id' => 'required',
            'retail_price' => 'required_if:is_wholeSale,==,retail',
            'wholesale_price' => 'required_if:is_wholeSale,==,wholesale',
            'wholesale_min_qty' => 'required_if:is_wholeSale,==,wholesale',
            'wholesale_sold_per' => 'required',
            'product_desc' => 'required',
            'standard_net_weight' => 'required',
            'standard_net_weight_unit' => 'required',
            'stocks' => 'required',
        ] );

        $product = new Product();
        $multiple_images = $request->file( 'images' );
        $multiple_images_path = '';
        $multiple_images_counter = 1;

        if ( $request->hasFile('images') ) {
            foreach($multiple_images as $single_image) {
                $productImage = $single_image;
                $productImageSaveAsName = time() . uniqid() . "-product." . $productImage->getClientOriginalExtension();
                $upload_path = 'storage/products/' . date('FY') . '/';
                $upload_path_url = 'products//' . date('FY') . '//';
                $product_image_url = $upload_path_url . $productImageSaveAsName;
                $success = $productImage->move($upload_path, $productImageSaveAsName);
                $multiple_images_path .= $product_image_url . ',';

                if ( $multiple_images_counter == 1 ) {
                    $product->cover_img = $product_image_url;
                }
                $multiple_images_counter++;
            }
        }
        
        $product->secondary_cover_img = $multiple_images_path;
        if ( Auth::user()->role->name == 'admin') {
            $product->shop_id = $request->shop_id;

        } else if ( Auth::user()->role->name == 'seller' ) {
            $product->shop_id = Auth::user()->shop->id;

        }

        $product->name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->description = $request->product_desc;
        $product->is_sale = $request->is_Sale;
        $product->is_pre_sale = $request->is_preSale;
        $product->sale_pct_deduction = ($request->is_Sale == 1) ? $request->sale_pct_deduction : '0';
        $product->is_whole_sale = ( $request->is_wholeSale == 'retail' ) ? false : true; // check if product is whole sale or retail
        $product->whole_sale_min_qty = $request->wholesale_min_qty;
        $product->product_user_id = $this->userId() ?? NULL; // add the user id of the current user
        $product->save();
        
        $productVariation = new ProductVariation;
        $productVariation->product_id = $product->id;
        $productVariation->variation_name = 'Regular';


        // 3 variations 
        // Wholesale only 
        // retail only 
        // wholesale and retail

        // wholesale and rretail
        // wholesale price vars if the form is not filled with wholesale ent 
        if ($request->wholesale_price == NULL || $request->wholesale_min_qty == NULL || $request->wholesale_min_qty == '' || $request->wholesale_price == '') {
            // retail only
            $productVariation->is_variation_wholesale = 'no';
        } else {
            // with wholesale
            // thus retail with wholesale will be reflected
            $productVariation->variation_price_per = $request->retail_price;
            $productVariation->variation_wholesale_price_per = $request->wholesale_price;
            $productVariation->variation_min_qty_wholesale = $request->wholesale_min_qty; 
            $productVariation->is_variation_wholesale = 'yes';
            $productVariation->is_variation_wholesale_only = 'no';
        }

        // wholesale only entity
        if ($request->retail_price == NULL || $request->retail_price == '') {
            $productVariation->is_variation_wholesale = 'yes';
            $productVariation->is_variation_wholesale_only = 'yes';
            $productVariation->variation_price_per = $request->wholesale_price;
            $productVariation->variation_wholesale_price_per = $request->wholesale_price;
            $productVariation->variation_min_qty_wholesale = $request->wholesale_min_qty; 
        } else {
            // retail only
            $productVariation->variation_price_per = $request->retail_price;
        }

        // quantity refer to stocks
        $productVariation->variation_quantity = $request->stocks;
        // net weight
        $productVariation->variation_net_weight = $request->standard_net_weight;
        $productVariation->variation_net_weight_unit = $request->standard_net_weight_unit;
        $productVariation->save();
    
        $productCategory = new ProductCategory();
        $productCategory->product_id = $product->id;
        $productCategory->category_id = $request->category_id;
        $productCategory->save();

        $adminnotif_ent = new adminNotifModel();
        $adminnotif_ent->action_type = 'Product addition';
        $adminnotif_ent->user_id = Auth::user()->id;
        $adminnotif_ent->action_description = 'Added ' . $product->name . ' to the products list';
        $adminnotif_ent->save();  
        
        if ( Auth::user()->role->name == 'admin' ) {
            return redirect( '/admin/manage_products' );

        } else if ( Auth::user()->role->name == 'seller' ) {
            return redirect( '/sellerpanel/products' );
        }

    }

    public function save_new_products_v2( Request $request ) {
        $this->validate( $request, [
            'product_name' => 'required',
            'images' => 'required',
            'category_id' => 'required',
            'retail_price' => 'required',
            'wholesale_price' => 'required_if:is_wholesale,==,on',
            'wholesale_min_qty' => 'required_if:is_wholesale,==,on',
            'wholesale_sold_per' => 'required_if:is_wholesale,==,on',
            'product_desc' => 'required',
            'standard_net_weight' => 'required',
            'standard_net_weight_unit' => 'required',
            'stocks' => 'required',
        ] );

        $is_wholesale = $request->is_wholesale == 'on' ? true : false;
        $has_variants = $request->has_vartiants == 'on' ? true : false;

        $product = new Product();
        $product->name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->description = $request->product_desc;
        $product->is_sale = $request->is_Sale;
        $product->is_pre_sale = 0;
        $product->sale_pct_deduction = 0;
        $product->shop_id = Auth::user()->shop->id;
        
        $product->is_whole_sale = $is_wholesale;
        $product->product_user_id = $this->userId() ?? NULL; // add the user id of the current user

        if ( $request->addl_images ) {
            $multiple_images = true;

            foreach ( $request->addl_images as $index => $addl_images ) {
                $movedImage = $this->uploadImagesV2( $addl_images );
                $is_featured = ( $request->featured_index == $index ) ? true : false;
                $images[] = array( $movedImage[2], $is_featured );
            }
        }
        
        /* if ( $request->hasFile( 'images' ) ) {
            $multiple_images = $request->file( 'images' );
            $images = array();

            foreach( $multiple_images as $index => $single_image ) {
                $image = $this->uploadImages( $single_image );
                $single_image->move( $image[0], $image[1] );
                $is_featured = ( $request->featured_index == $index ) ? true : false;
                $images[] = array( $image[2], $is_featured );
            }
        } */

        if ( Auth::user()->role->name == 'admin' ) {
            $product->shop_id = $request->shop_id;

        } else if ( Auth::user()->role->name == 'seller' ) {
            $product->shop_id = Auth::user()->shop->id;
        }
           
        if ( $product->save() && isset( $multiple_images ) ) {
            foreach( $images as $image ) {
                $productImage = new ProductImage;
                $productImage->product_id = $product->id;
                $productImage->is_featured = $image[1];
                $productImage->image = $image[0];
                $productImage->save();
            }
        }

        $checkVariants = $has_variants && ( $request->variant_names && count( $request->variant_names ) > 0 );

        $productVariation = new ProductVariation;
        $productVariation->product_id = $product->id;
        $productVariation->variation_name = $checkVariants ? $request->product_name : "Regular";
        $productVariation->is_variation_wholesale = $is_wholesale ? 'yes' : 'no';
        $productVariation->is_variation_wholesale_only = $is_wholesale ? 'yes' : 'no';
        $productVariation->variation_price_per = $request->retail_price;
        $productVariation->variation_wholesale_price_per = $is_wholesale ? $request->wholesale_price : 0;
        $productVariation->variation_min_qty_wholesale = $is_wholesale ? $request->wholesale_min_qty : 0;
        $productVariation->variation_quantity = $request->stocks;
        $productVariation->variation_sold_per = $request->wholesale_sold_per;
        $productVariation->variation_net_weight = $request->standard_net_weight;
        $productVariation->variation_net_weight_unit = $request->standard_net_weight_unit;
        $productVariation->save();

        if ( $checkVariants ) {
            $multiple_variation_names = $request->variant_names;
            $multiple_variation_prices = $request->variant_prices;
            $multiple_variation_price_whole_sale = $is_wholesale ? $request->wholesale_price : 0;
    
            $multiple_variation_min_qty_wholesale = $is_wholesale ? $request->wholesale_min_qty : 0;
            $multiple_variation_net_weight = $request->standard_net_weight;
            $multiple_variation_net_weight_unit = $request->standard_net_weight_unit;
            $multiple_variation_stocks = $request->variant_stocks;
    
            foreach ( $multiple_variation_names as $index => $variation_name ) {      
                $productVariation = new ProductVariation;
                $productVariation->product_id = $product->id;
                $productVariation->variation_name = $multiple_variation_names[$index];
                $productVariation->variation_min_qty_wholesale = $multiple_variation_min_qty_wholesale;
                $productVariation->variation_quantity = $multiple_variation_stocks[$index];
                $productVariation->variation_sold_per = $request->wholesale_sold_per;
                $productVariation->variation_net_weight = $multiple_variation_net_weight;
                $productVariation->variation_net_weight_unit = $multiple_variation_net_weight_unit;
                $productVariation->is_variation_wholesale = $is_wholesale ? 'yes' : 'no';
                $productVariation->variation_price_per = $multiple_variation_prices[$index];
                $productVariation->variation_wholesale_price_per = $multiple_variation_price_whole_sale;
                $productVariation->is_variation_wholesale_only = $is_wholesale ? 'yes' : 'no';
                $productVariation->save();
            }

        }

        $productCategory = new ProductCategory();
        $productCategory->product_id = $product->id;
        $productCategory->category_id = $request->category_id;
        $productCategory->save();

        $adminnotif_ent = new adminNotifModel();
        $adminnotif_ent->action_type = "Product addition";
        $adminnotif_ent->user_id = Auth::user()->id;
        $adminnotif_ent->action_description = "Added {$product->name} to the products list";
        $adminnotif_ent->save();
        
        if ( Auth::user()->role->name == 'admin' ) {
            return redirect( '/admin/manage_products' );

        } else if ( Auth::user()->role->name == 'seller' ) {
            return redirect( '/sellerpanel/products' )->withSuccess( 'New Product has been added.');
        }
    }

    function saveProduct_edit_form(Request $req) {
        $product = Product::where('id', $req->product_id)->first();
        $multiple_images = $req->file('images');
        $multiple_images_path = '';
        $multiple_images_counter = 1;
        if ($req->hasFile('images')) {
            foreach($multiple_images as $single_image) {
                $productImage = $single_image;
                $productImageSaveAsName = time() . uniqid() . "-product." . $productImage->getClientOriginalExtension();
                $upload_path = 'storage/products/' . date('FY') . '/';
                $upload_path_url = 'products//' . date('FY') . '//';
                $product_image_url = $upload_path_url . $productImageSaveAsName;
                $success = $productImage->move($upload_path, $productImageSaveAsName);
                $multiple_images_path .= $product_image_url . ',';
                if ($multiple_images_counter == 1) {
                    $product->cover_img = $product_image_url;
                }
                $multiple_images_counter++;
            }
        }
        if ($req->hasFile('images')) {
            $product->secondary_cover_img = $multiple_images_path;
        }
        if ($req->file('new_product_image') != null) {
            $productImage = $req->file('new_product_image');
            $productImageSaveAsName = time() . uniqid() . "-product." . $productImage->getClientOriginalExtension();
            $upload_path = 'storage/products/' . date('FY') . '/';
            $upload_path_url = 'products\\' . date('FY') . '\\';
            $product_image_url = $upload_path_url . $productImageSaveAsName;
            $success = $productImage->move($upload_path, $productImageSaveAsName);
            $product->cover_img = $product_image_url;
        }
        if (Auth::user()->role->name == 'admin') {
            $product->shop_id = $req->shop_id;
        } else if (Auth::user()->role->name == 'seller') {
            $product->shop_id = Auth::user()->shop->id;
        }
            $product->name = $req->product_name;
            $product->description = $req->product_desc;
            $product->price = $req->product_price;
            $product->is_sale = $req->is_Sale;
            $product->sold_by = $req->is_sold_by;
            $product->sale_pct_deduction = ($req->is_Sale == 1) ? $req->sale_pct_deduction : '0';
            $product->is_whole_sale = $req->is_wholeSale;
            $product->whole_sale_min_qty = $req->wholesale_min_qty;
            $product->whole_sale_pct_deduction = $req->wholesale_pct_deduct;
            $product->is_pre_sale = $req->is_preSale;
            $product->pre_sale_deadline = $req->pre_sale_deadline;
            $product->stocks = $req->stocks;

        $product->save();
        $product_variation_delete_tmp = ProductVariation::where('product_id', $req->product_id)->delete();

        if ($req->is_have_variation == 'yes') {
            // clear product variation in editing
            $multiple_variation_counter = 0;
            $multiple_variation_names = $req->variation_name;
            //ratail_price
            $multiple_variation_price = $req->variation_price;
            // wholesale price
            $multiple_variation_price_whole_sale = $req->variation_price_wholesale;
            $multiple_variation_quantity = $req->variation_quantity;
            $multiple_variation_net_weight = $req->variation_net_weight;
            $multiple_variation_sold_per = $req->variation_sold_per;
    
            foreach($multiple_variation_names as $variation_name) {
                $productVariation = new ProductVariation;
                $productVariation->product_id = $req->product_id;
                $productVariation->variation_name = $variation_name;
                $productVariation->variation_price_per = $multiple_variation_price[$multiple_variation_counter];
                                $productVariation->multiple_variation_price_whole_sale = $multiple_variation_price_whole_sale[$multiple_variation_counter];
                $productVariation->variation_quantity = $multiple_variation_quantity[$multiple_variation_counter];
                $productVariation->variation_net_weight = $multiple_variation_net_weight[$multiple_variation_counter] * 0.001;
                $productVariation->save();
                $multiple_variation_counter++;
            }
        } else {
            $productVariation = new ProductVariation;
            $productVariation->product_id = $product->id;
            $productVariation->variation_name = 'Regular';
            // set regular price to regular variation
            $productVariation->variation_price_per = $req->product_price;
            $productVariation->variation_quantity = $req->stocks;
            $productVariation->variation_net_weight = $req->product_weight_regular;
            $productVariation->save();
        }
        

        $productCategory = new ProductCategory();
        $productCategory->product_id = $product->id;
        $productCategory->category_id = $req->category_id;
        $productCategory->save();
        if (Auth::user()->role->name == 'admin') {
            return redirect('/admin/manage_products');
        } else if (Auth::user()->role->name == 'seller') {
            return redirect('/sellerpanel/products');
        }

        if (Auth::user()->role->name == 'admin') {
            return redirect('/admin/manage_products');
        } else if (Auth::user()->role->name == 'seller') {
            return redirect('/sellerpanel/products');
        }

    }

    function hide_product($product_id) {
        // hide product
        $product_entity = Product::where('id', $product_id);
        $product_entity->delete();
        return back();
    }

    function saveNewProductRegular(Request $req) {
        
        $product = new Product();
        $multiple_images = $req->file('images');
        $multiple_images_path = '';
        $multiple_images_counter = 1;
        if ($req->hasFile('images')) {
            foreach($multiple_images as $single_image) {
                $productImage = $single_image;
                $productImageSaveAsName = time() . uniqid() . "-product." . $productImage->getClientOriginalExtension();
                $upload_path = 'storage/products/' . date('FY') . '/';
                $upload_path_url = 'products//' . date('FY') . '//';
                $product_image_url = $upload_path_url . $productImageSaveAsName;
                $success = $productImage->move($upload_path, $productImageSaveAsName);
                $multiple_images_path .= $product_image_url . ',';
                if ($multiple_images_counter == 1) {
                    $product->cover_img = $product_image_url;
                }
                $multiple_images_counter++;
            }
        }

        $product->secondary_cover_img = $multiple_images_path;
        $product->net_weight = ($req->product_weight_regular != NULL) ? $req->product_weight_regular : '';
        
        if (Auth::user()->role->name == 'admin') {
            $product->shop_id = $req->shop_id;

        } else if (Auth::user()->role->name == 'seller') {
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
            $product->save();
  
                // changelog include variation price add product
                $productVariation = new ProductVariation;
                $productVariation->product_id = $product->id;
                $productVariation->variation_name = 'Regular';
                $productVariation->variation_price_per_retail = $request->product_price;
                $productVariation->variation_wholesale_price_per = $request->regular_product_wholesale_price;
                $productVariation->variation_min_qty_wholesale = $request->regular_product_minimum_wholesale_quantity;
                $productVariation->variation_quantity = $request->regular_retail_stocks;
                $productVariation->variation_net_weight = $request->variation_net_weight;
                // variation min qty
         
                // wholesale retail price and note there is a minimum quanitity 
                // 
                // $productVariation->variation_min_qty_wholesale = $multiple_variation_variation_min_qty_wholesale[$multiple_variation_counter];
                // $productVariation->variation_sold_per = $sold_per_global;
                $productVariation->variation_sold_per = $multiple_variation_sold_per[$multiple_variation_counter]; 
         
                $productVariation->save();
                $multiple_variation_counter++;
     
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
        } else if (Auth::user()->role->name == 'seller') {
            return redirect('/sellerpanel/products');
        }
    }

    public function uploadImages( $image ) {
        $productImageSaveAsName = time() . uniqid() . "-product." . $image->getClientOriginalExtension();
        $upload_path = 'storage/products/' . date( 'FY' ) . '/';
        $upload_path_url = 'products/' . date( 'FY' ) . '/';
        $product_image_url = $upload_path_url . $productImageSaveAsName;

        return [ $upload_path, $productImageSaveAsName, $product_image_url ];
    }

    public function uploadImagesV2( $image ) {
        $base64_str = substr( $image, strpos( $image, "," ) + 1 );
        $image_decoded = base64_decode( $base64_str );

        $extension = explode( '/', mime_content_type( $image ) )[1];
        $productImageSaveAsName = time() . uniqid() . "-product." . $extension;
        $upload_path = 'storage/products/' . date( 'FY' ) . '/';
        $upload_path_url = 'products/' . date( 'FY' ) . '/';
        $product_image_url = $upload_path_url . $productImageSaveAsName;

        file_put_contents( public_path() . "/" . $upload_path . $productImageSaveAsName , $image_decoded );

        return [ $upload_path, $productImageSaveAsName, $product_image_url ];
    }

    public function update_product_v2( Request $request ) {
        $this->validate( $request, [
            'product_name' => 'required',
            'category_id' => 'required',
            'retail_price' => 'required',
            'wholesale_price' => 'required_if:is_wholesale,==,on',
            'wholesale_min_qty' => 'required_if:is_wholesale,==,on',
            'wholesale_sold_per' => 'required_if:is_wholesale,==,on',
            'product_desc' => 'required',
            'standard_net_weight' => 'required',
            'standard_net_weight_unit' => 'required',
            'stocks' => 'required',
        ] );

        $is_wholesale = $request->is_wholesale == 'on' ? true : false;
        $has_variants = $request->has_vartiants == 'on' ? true : false;

        $product = Product::find( $request->product_id );
        $product->name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->description = $request->product_desc;
        $product->is_sale = 0;
        $product->is_pre_sale = 0;
        $product->sale_pct_deduction = 0;
        $product->is_whole_sale = $is_wholesale;

        if ( $request->addl_images ) {
            $multiple_images = true;

            foreach ( $request->addl_images as $index => $addl_images ) {
                $movedImage = $this->uploadImagesV2( $addl_images );
                $is_featured = ( $request->featured_index == $index ) ? true : false;
                $images[] = array( $movedImage[2], $is_featured );
            }
        }
        
        /* if ( $request->hasFile( 'images' ) ) {
            $multiple_images = $request->file( 'images' );
            $images = array();

            foreach( $multiple_images as $index => $single_image ) {
                $image = $this->uploadImages( $single_image );
                $single_image->move( $image[0], $image[1] );
                $is_featured = false;

                if ( $request->featured_type == 'new' && $request->featured_index == $index ) {
                    $is_featured = true;
                }
                $images[] = array( $image[2], $is_featured );
            }
        } */

        if ( Auth::user()->role->name == 'admin' ) {
            $product->shop_id = $request->shop_id;

        } else if ( Auth::user()->role->name == 'seller' ) {
            $product->shop_id = Auth::user()->shop->id;
        }

        $this->resetFeaturedImage( $request->product_id );
        if ( $request->removed_images !== '' ) $this->removeImages( $request );
        if ( $request->featured_type == 'old' ) $this->setFeaturedImage( $request );
           
        if ( $product->save() && isset( $multiple_images ) ) {
            foreach( $images as $image ) {
                $productImage = new ProductImage;
                $productImage->product_id = $product->id;
                $productImage->is_featured = $image[1];
                $productImage->image = $image[0];
                $productImage->save();
            }
        }

        $checkVariants = $has_variants && ( $request->variant_names && count( $request->variant_names ) > 0 );

        if ( $request->removed_variants ) {
            $removedVariants = explode( ',', $request->removed_variants );
            foreach( $removedVariants as $removedVariant ) {
                ProductVariation::find( $removedVariant )->delete();
            }
        }

        $firstVariation = ProductVariation::where( 'product_id', $request->product_id )->first();

        if ( $firstVariation ) {
            $firstVariation->variation_name = $checkVariants ? $request->product_name : "Regular";
            $firstVariation->is_variation_wholesale = $is_wholesale ? 'yes' : 'no';
            $firstVariation->is_variation_wholesale_only = $is_wholesale ? 'yes' : 'no';
            $firstVariation->variation_price_per = $request->retail_price;
            $firstVariation->variation_wholesale_price_per = $is_wholesale ? $request->wholesale_price : 0;
            $firstVariation->variation_min_qty_wholesale = $is_wholesale ? $request->wholesale_min_qty : 0;
            $firstVariation->variation_quantity = $request->stocks;
            $firstVariation->variation_sold_per = $request->wholesale_sold_per;
            $firstVariation->variation_net_weight = $request->standard_net_weight;
            $firstVariation->variation_net_weight_unit = $request->standard_net_weight_unit;
            $firstVariation->save();
        }

        if ( $checkVariants ) {
            $multiple_variation_names = $request->variant_names;
            $multiple_variant_ids = $request->variant_id;
            $multiple_variation_prices = $request->variant_prices;
            $multiple_variation_price_whole_sale = $is_wholesale ? $request->wholesale_price : 0;
    
            $multiple_variation_min_qty_wholesale = $is_wholesale ? $request->wholesale_min_qty : 0;
            $multiple_variation_net_weight = $request->standard_net_weight;
            $multiple_variation_net_weight_unit = $request->standard_net_weight_unit;
            $multiple_variation_stocks = $request->variant_stocks;
    
            foreach ( $multiple_variation_names as $index => $variant ) {
                $productVariation = isset( $multiple_variant_ids[$index] ) ? ProductVariation::find( $multiple_variant_ids[$index] ) : new ProductVariation;
                $productVariation->product_id = $request->product_id;
                $productVariation->variation_name = $multiple_variation_names[$index];
                $productVariation->variation_min_qty_wholesale = $multiple_variation_min_qty_wholesale;
                $productVariation->variation_quantity = $multiple_variation_stocks[$index];
                $productVariation->variation_sold_per = $request->wholesale_sold_per;
                $productVariation->variation_net_weight = $multiple_variation_net_weight;
                $productVariation->variation_net_weight_unit = $multiple_variation_net_weight_unit;
                $productVariation->is_variation_wholesale = $is_wholesale ? 'yes' : 'no';
                $productVariation->variation_price_per = $multiple_variation_prices[$index];
                $productVariation->variation_wholesale_price_per = $multiple_variation_price_whole_sale;
                $productVariation->is_variation_wholesale_only = $is_wholesale ? 'yes' : 'no';
                $productVariation->save();
            }
        } else {
            $_productVariation = ProductVariation::where( 'product_id', $request->product_id )->first();
            $productVariations = ProductVariation::where( 'product_id', $request->product_id )->get();

            if ( $productVariations ) {
                foreach( $productVariations as $productVariation ) {
                    if ( $productVariation->id !== $_productVariation->id ) $productVariation->delete();
                }
            }

            $_productVariation->variation_name = "Regular";
            $_productVariation->save();
        }
        
        if ( Auth::user()->role->name == 'admin' ) {
            return redirect( '/admin/manage_products' );

        } else if ( Auth::user()->role->name == 'seller' ) {
            return redirect( '/sellerpanel/products' )->withSuccess( 'Product has been updated successfully.');
        }
    }

    public function resetFeaturedImage( $id ) {
        ProductImage::where( 'product_id', $id )->update([
            'is_featured' => false
        ]);
    }

    public function removeImages( $request ) {
        $ids = explode( ',', $request->removed_images );
        ProductImage::where( 'product_id', $request->product_id )->whereIn( 'id', $ids )->delete();
    }

    public function setFeaturedImage( $request ) {
        ProductImage::find( $request->featured_index )->update([ 'is_featured' => true ]);
    }

    public function restoreForm( $id ) {
        $product = Product::withTrashed()->find( $id );

        $backUrl = '/sellerpanel/products';
        $panel_name = 'Restore';
        return view( 'sellerPanel.products.restore' )->with( compact( 'backUrl', 'panel_name', 'id', 'product' ) );
    }

    public function restoreProduct( Request $request ) {
        $product = Product::withTrashed()->find( $request->id );

        if ( $product->product_user_id !== $request->user_id ) {
            return response()->json( [
                'success' => false,
                'message' => "You're not authorized to restore this product!"
            ] );

        } else {
            $product->restore();

            return response()->json( [
                'success' => true,
                'message' => "Product has been restored!"
            ] );
        }
    }

    public function deleteProduct( Request $request, $id ) {
        $product = Product::withTrashed()->find( $id );
        $product->is_confirmed_deleted = TRUE;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => "Product has been completely deleted!"
        ]);
    }
 
}