<?php

namespace App\Exports;

use App\Helpers;
use App\Product;
use App\ProductVariation;
use App\SubOrder;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Orders implements FromCollection, WithHeadings
{
    protected $type, $interval, $helpers, $month, $collection;

    public function __construct( $type, $interval, $month )
    {
        $this->type = $type;
        $this->interval = $interval;
        $this->month = $month;
        $this->helpers = new Helpers;
        $this->collection = new Collection();
    }

    public function headings(): array
    {
        $headers = [ "Order Number", "Customer Name", "Total", "Shop Name", "Status", "Item Name", "Qty", "Variety", "Price", "Sub Total" ];
        return [ [ "List of all Orders" ], $headers ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if ( $this->interval !== 'top' ) {
            $is_pick_up = ( $this->type == 'pickup' ) ? 'yes' : 'no';
            $orders = SubOrder::where( 'is_pick_up', $is_pick_up )->latest()->get();

            foreach ( $orders as $index => $order ) {
                if ( $order->order ) {
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

                        if ( $order_status == "Completed" ) $isPaid = "Paid";

                        $product_variety_ent = ProductVariation::where( 'id', $item->pivot->variation_id )->first();
                        $main_product = Product::find( $product_variety_ent->product_id );
                        $item_product_price_proc = $product_variety_ent->variation_price_per;
        
                        $_data = [
                            "#" . $order->order->id,
                            $order->order->shipping_fullname,
                            "Peso " . Helpers::numeric( $order->order->grand_total ),
                            $main_product->shop->name,
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

        return $this->collection;
    }
}
