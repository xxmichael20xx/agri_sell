<?php

namespace App\Http\Controllers;

use App\adminNotifModel;
use App\Exports\ActivityLogs;
use App\Exports\Orders;
use App\Exports\Payouts;
use App\Exports\Refunds;
use App\Exports\SellerPayouts;
use App\Exports\SellerProducts;
use App\Exports\SellerRefunds;
use App\Exports\Shop;
use App\Exports\TransactionHistory;
use App\Exports\Users;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ReportGenerationPdfController extends Controller
{
    // Admin Report Generation
    public function time() {
        $time = Carbon::parse( time() )->format( 'M_d_Y_h_i_s' );

        return $time;
    }
    
    public function activityLogs( Request $request ) {
        $export = new ActivityLogs();
        $headers = $export->headings();
        $data = $export->collection();

        return view( 'admin.export.pdf.template', compact( 'headers', 'data' ) );
    }

    public function refunds( Request $request, $type, $interval ) {
        $export = new Refunds( $type, $interval );
        $headers = $export->headings();
        $data = $export->collection();

        return view( 'admin.export.pdf.template', compact( 'headers', 'data' ) );
    }

    public function shops( Request $request, $interval, $type, $month = NULL ) {
        if ( ! $month ) {
            $month = Carbon::parse( now () )->month;
        }
        
        $export = new Shop( $interval, $type, $month );
        $headers = $export->headings();
        $data = $export->collection();

        return view( 'admin.export.pdf.template', compact( 'headers', 'data' ) );
    }

    public function users( Request $request, $interval, $role_id ) {
        $export = new Users( $interval, $role_id );
        $headers = $export->headings();
        $data = $export->collection();

        return view( 'admin.export.pdf.template', compact( 'headers', 'data' ) );
    }

    public function payouts( Request $request, $status_id, $interval ) {
        switch ( $status_id ) {
            case 1:
                $columns = [
                    'column' => 'updated_at',
                    'header' => 'Date Confirmed',
                    'type' => 'Confirmed'
                ];
                break;

            case 0:
                $columns = [
                    'column' => 'updated_at',
                    'header' => 'Date Rejected',
                    'type' => 'Rejected'
                ];
                break;

            default:
                $columns = [
                    'column' => 'created_at',
                    'header' => 'Date Requested',
                    'type' => 'Requests'
                ];
                break;
        }

        $export = new Payouts( $status_id, $interval, $columns );
        $headers = $export->headings();
        $data = $export->collection();

        return view( 'admin.export.pdf.template', compact( 'headers', 'data' ) );
    }

    public function orders( Request $request, $type, $interval ) {
        $export = new Orders( $type, $interval );
        $headers = $export->headings();
        $data = $export->collection();

        return view( 'admin.export.pdf.template', compact( 'headers', 'data' ) );
    }

    public function transactions( Request $request, $interval ) {
        $export = new TransactionHistory( $interval );
        $headers = $export->headings();
        $data = $export->collection();

        return view( 'admin.export.pdf.template', compact( 'headers', 'data' ) );
    }

    // Seller Report Generation
    public function sellerProducts( Request $request, $type, $interval ) {
        $export = new SellerProducts( $type, $interval );
        $headers = $export->headings();
        $data = $export->collection();

        return view( 'admin.export.pdf.template', compact( 'headers', 'data' ) );
    }

    public function sellerRefunds( Request $request, $interval ) {
        $export = new SellerRefunds( $interval );
        $headers = $export->headings();
        $data = $export->collection();

        return view( 'admin.export.pdf.template', compact( 'headers', 'data' ) );
    }

    public function sellerPayouts( Request $request, $interval ) {
        $export = new youts( $interval );
        $headers = $export->headings();
        $data = $export->collection();

        return view( 'admin.export.pdf.template', compact( 'headers', 'data' ) );
    }
}
