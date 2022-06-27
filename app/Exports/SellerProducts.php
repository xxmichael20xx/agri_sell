<?php

namespace App\Exports;

use App\Helpers;
use App\Product;
use App\ProductCategory;
use App\ProductVariation;
use App\SubOrder;
use App\SubOrderItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SellerProducts implements FromCollection, WithHeadings
{
    protected $collection, $type, $interval, $helpers;

    public function __construct( $type, $interval )
    {
        $this->collection = new Collection();
        $this->type = $type;
        $this->interval = $interval;
        $this->helpers = new Helpers;
    }

    public function headings(): array
    {
        $headers = [];

        switch ( $this->type ) {
            case 'list':
                $headers = [
                    "Product #", "Name", "Category", "Type", "Price", "Wholesale Price", "Weight", "Stocks", "Has Variants", "Variant Name", "Variant Price", "Variant Weight", "Variant Stock"
                ];
                break;

            case 'history':
                $headers = [
                    "Order Number", "Customer Name", "Total", "Is Order Paid?", "Status", "Item Name", "Qty", "Variety", "Price", "Sub Total"
                ];
                break;
            
            default:
                $headers = [
                    "Product #", "Name", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                ];
                break;
        }

        return $headers;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        switch ( $this->type ) {
            case 'list':
                $this->productLists();
                break;

            case 'history':
                $this->productsHistory();
                break;
            
            default:
                $this->monthlyOrders();
                break;
        }

        return $this->collection;
    }

    public function productLists() {
        // Headers
        // Product #, Name, Category, Type, Price, "Wholesale Price", Weight, Stocks, Has Variants, Variant Name, Variant Price, Variant Weight, Variant Stock
        $products = Product::where( 'product_user_id', auth()->user()->id )->get();

        foreach ( $products as $product_index => $product ) {
            $hasVariants = ProductVariation::where( 'product_id', $product->id )->get();
            $first = $hasVariants[0];
            $_data = [
                '#' . $product->id,
                $product->name,
                $product->category->category->name,
                $product->is_whole_sale ? 'Wholesale' : 'Retail',
                "Peso " . $this->helpers->numeric( $first->variation_price_per ),
                $product->is_whole_sale ? $this->helpers->numeric( $first->variation_wholesale_price_per ) : "N/A",
                $this->helpers->numeric( $first->variation_net_weight ) . $first->variation_net_weight_unit,
                $this->helpers->numeric( $first->variation_quantity ),
                $hasVariants->count() > 1 ? 'Yes' : 'No',
                "N/A", "N/A", "N/A", "N/A"
            ];

            $data = (object) $_data;
            $this->collection->push( $data );

            if ( $hasVariants->count() > 1 ) {
                foreach ( $hasVariants as $variant_index => $variant ) {
                    if ( $variant_index > 0 ) {
                        $_data = [
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            $variant->variation_name,
                            $variant->variation_price_per,
                            $variant->variation_net_weight . $variant->variation_net_weight_unit,
                            $variant->variation_quantity,
                        ];
            
                        $data = (object) $_data;
                        $this->collection->push( $data );
                    }
                }
            }
        }
    }

    public function productsHistory() {
        // Header
        // "Order Number", "Customer Name", "Total", "Is Order Paid?", "Status", "Item Name", "Qty", "Variety", "Price", "Sub Total"
        $orders = SubOrder::where( 'seller_id', auth()->user()->id )->latest();

        if ( $this->interval == "full" ) {
            $orders = $orders->get();

        } else {
            $orders = $orders->whereMonth( Carbon::parse( now() )->month )->get();
        }

        foreach ( $orders as $order_index => $order ) {
            if ( $order->order ) {
                $is_pick_up = $order->is_pick_up;

                if ( $is_pick_up == 'yes' ) {
                    switch ( $order->pick_up_status_id ) {
                        case 1:
                            $order_status = "Pending";
                            break;
                        
                        case 2:
                            $order_status = "Ready for Pickup";
                            break;
                        
                        case 3:
                            $order_status = "Cancelled";
                            break;
    
                        case 5:
                            $order_status = "Completed";
                            break;
    
                        default:
                            $order_status = "Confirmed";
                            break;
                    }
    
                } else {
                    switch ( $order->status_id ) {
                        case 1:
                            $order_status = "Pending";
                            break;
                        
                        case 2:
                            $order_status = "Confirmed";
                            break;
                        
                        case 3:
                            $order_status = "Picked Up";
                            break;
    
                        case 4:
                            $order_status = "On Delivery";
                            break;
    
                        case 5:
                            $order_status = "Completed";
                            break;
    
                        case 6:
                            $order_status = "Delivery Failed";
                            break;
    
                        case 7:
                            $order_status = "Cancelled";
                            break;
    
                        default:
                            $order_status = "Ready";
                            break;
                    }
    
                }

                $isPaid = $order->order->is_paid || $order->order->payment_method == 'agrisell_coins' ? "Paid" : "Not Paid";
                $method = $this->helpers->toWords( $order->order->payment_method );
                $items = $order->order->items;

                if ( count( $items ) < 2 ) {
                    $item = $items[0];

                    $product_variety_ent = ProductVariation::where( 'id', $item->pivot->variation_id )->first();
                    $item_product_price_proc = $product_variety_ent->variation_price_per;
    
                    $_data = [
                        "#" . $order->order->id,
                        $order->order->shipping_fullname,
                        "Peso " . Helpers::numeric( $order->order->grand_total ),
                        $isPaid . ", Method: {$method}",
                        $order_status,
                        $item->name,
                        Helpers::numeric( $item->pivot->quantity ),
                        $product_variety_ent->variation_name,
                        "Peso " . Helpers::numeric( $item_product_price_proc ),
                        "Peso " . Helpers::numeric( $item->pivot->quantity * $item->pivot->price )
                    ];
    
                    $data = ( object ) $_data;
                    $this->collection->push( $data );

                } else {
                    foreach ( $items as $item_index => $item ) {
                        $product_variety_ent = ProductVariation::where( 'id', $item->pivot->variation_id )->first();
                        $item_product_price_proc = $product_variety_ent->variation_price_per;
                        
                        $_data_head_empty = [ '', '', '', '', '' ];
                        $_data_head = [
                            "#" . $order->order->id,
                            $order->order->shipping_fullname,
                            "Peso " . Helpers::numeric( $order->order->grand_total ),
                            $isPaid . ", Method: {$method}",
                            $order_status
                        ];

                        $_data_body = [
                            $item->name,
                            Helpers::numeric( $item->pivot->quantity ),
                            $product_variety_ent->variation_name,
                            "Peso " . Helpers::numeric( $item_product_price_proc ),
                            "Peso " . Helpers::numeric( $item->pivot->quantity * $item->pivot->price ) 
                        ];

                        $which_head = $item_index == 0 ? $_data_head : $_data_head_empty;
                        $_data = array_merge( $which_head, $_data_body );
        
                        $data = ( object ) $_data;
                        $this->collection->push( $data );
                    }
                }
            }
        }
    }

    public function monthlyOrders() {
        // Headers
        // Product #, Name, Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sept, Oct, Nov, Dec
        $products = Product::where( 'product_user_id', auth()->user()->id )->get();

        foreach ( $products as $product_index => $product ) {
            $months = [];
            $year = Carbon::now()->year;

            for ( $i = 1; $i <= 12; $i++ ) { 
                $current = Carbon::parse( $year . '-' . $i );

                $orders = SubOrderItem::where( 'product_id', $product->id )
                    ->whereYear( 'created_at', $year )
                    ->whereMonth( 'created_at', $current->month )
                    ->groupBy( 'sub_order_id' )
                    ->get();
                $months[] = $orders->count() > 0 ? $this->helpers->numeric( $orders->count() ) : "No Sales";
            }

            $_data = [
                '#' . $product->id,
                $product->name
            ];
            $_data = array_merge( $_data, $months );
            $data = (object) $_data;

            $this->collection->push( $data );
        }
    }
}
