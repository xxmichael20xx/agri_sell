<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Product;
use App\Order;
use App\SubOrder;
use DB;
class ShopsAdminController extends Controller
{
    function index(){
        $shops = Shop::where('is_active', 1)->get();
        return view('admin.shops.index')->with('shops', $shops)->with('panel_name', 'shops');
    }

    function more_info($shop_id){
        $shop = Shop::where('id', $shop_id)->first();
        $shopProducts = Product::where('shop_id', $shop->id)->get();
        $sumAverageRating = 0;
        $ratings_ocurr = 0;
        foreach($shopProducts as $shopProduct){
        $sumAverageRating += $shopProduct->averageRating();
        $ratings_ocurr++;
        }
        $shopAveRating = 0;
        if($ratings_ocurr != 0 && $sumAverageRating != 0){
        $shopAveRating = round($sumAverageRating/$ratings_ocurr, 1);
        }else{
        $shopAveRating = 'Unrated';
        }
        $total_sales = 0;
        $order_count = SubOrder::where('seller_id', $shop->owner->id)->count();
        $order_items = SubOrder::where('seller_id', $shop->owner->id)->get();
        $order_item_price;
        $str_order_id = "";
        
        foreach($order_items as $order_item){
            if($order_item->status == 'completed')
            foreach($order_item->items as $order_ent){
                $itemprice;
                $uniprice;
                $itemprice = $order_ent->price;
                if($order_ent->is_sale == 1){
                    $itemprice = $order_ent->price - (($order_ent->sale_pct_deduction/100) * $order_ent->price);
                }
                $uniprice = $itemprice * $order_ent->pivot->quantity;
                $total_sales += $uniprice;
                $str_order_id .= "\n " . $order_ent->pivot->quantity . $order_ent->name . $order_ent->price;
    
            }
        }
        $total_commission_deduction = 10;
        $total_sales_deduction = $total_sales - (($total_commission_deduction/100) * $total_sales);
        $total_sales_deduction_diff = $total_sales - $total_sales_deduction;
       
        // final variable order_count total_sales   shopAveRating 
        return view('admin.shops.more_info')->with('shop', $shop)->with('panel_name', 'shops')
        ->with(compact('order_count', 'total_sales', 'shopAveRating'));
    }

    function edit_shop_panel($shop_id){
        $shop = Shop::where('id', $shop_id)->first();
        return view('admin.shops.edit_shop')->with('shop', $shop)->with('panel_name', 'shops');
    }

    function edit_shop_panel_submit(Request $req){
        
        $shop = Shop::where('id', $req->shop_id)->first();
        $shop->name = $req->shop_name;
        $shop->description = $req->shop_description;

        if($req->file('shop_banner') != null){
        $shopbannerImage = $req->file('shop_banner');
        $shopbannerSaveAsName = time() . uniqid() . "-shop_banner." . $shopbannerImage->getClientOriginalExtension();
        $upload_path = 'storage/shop_banner/' . date('FY') . '/';

        $shopbannerUrl = 'shop_banner\\' . date('FY') . '\\' . $shopbannerSaveAsName;
        $success = $shopbannerImage->move($upload_path, $shopbannerSaveAsName);
        $shop->shop_bg = $shopbannerUrl;
        }
    
    
        $shop->save();

        if($req->is_active != null){
            DB::table('shops')->where('id', $req->shop_id)->update(['is_active' => '1']);
        }else{
            DB::table('shops')->where('id', $req->shop_id)->update(['is_active' => '0']);

        }
        return back();

    }
    function inactive_shop($shop_id){
        DB::table('shops')->where('id', $shop_id)->update(['is_active'=> '0']);
        return back();
    }
    
    function active_shop($shop_id){
        DB::table('shops')->where('id', $shop_id)->update(['is_active'=> '1']);
        return back();
    }

    function delete_shop($shop_id){
        Shop::where('id', $shop_id)->delete();
        return back();
    }
}
