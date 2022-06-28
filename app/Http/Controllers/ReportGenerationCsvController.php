<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;

class ReportGenerationCsvController extends Controller
{
    // Admin Report Generation
    public function time() {
        $time = Carbon::parse( time() )->format( 'M_d_Y_h_i_s' );

        return $time;
    }
    public function activityLogs( Request $request ) {
        $fileName = $this->time() . "_Activity_Logs.csv";
        return \Excel::download( new ActivityLogs, $fileName );
    }

    public function refunds( Request $request, $type, $interval ) {
        $fileName = $this->time() . "_" . ucwords( $interval ) . "_Refunds_" . ucwords( $type ) . ".csv";
        return \Excel::download( new Refunds( $type, $interval ), $fileName );
    }

    public function shops( Request $request, $interval, $type ) {
        $fileName = $this->time() . "_" . ucwords( $interval ) . "_Approved_Shops_" . ucwords( $type ) . ".csv";
        return \Excel::download( new Shop( $interval, $type ), $fileName );
    }

    public function users( Request $request, $interval, $role_id ) {
        $roleType = "";

        switch ( $role_id ) {
            case '2':
                $roleType = 'Regular';
                break;

            case '1':
                $roleType = "Admin";
                break;

            case '5':
                $roleType = "Rider";
                break;

            case '3':
                $roleType = "Seller";
                break;

            default:
                $roleType = "Coins_Employee";
                break;
        }

        $fileName = $this->time() . "_" . ucwords( $interval ) . "_Users_" . $roleType . ".csv";
        return \Excel::download( new Users( $interval, $role_id ), $fileName );
    }

    public function payouts( Request $request, $status_id, $interval ) {
        $type = "";
        $columns = null;

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

        $fileName = $this->time() . "_" . $columns['type'] . "_" . ucwords( $interval ) . "_Payout" . ".csv";
        return \Excel::download( new Payouts( $status_id, $interval, $columns ), $fileName );
    }

    public function orders( Request $request, $type, $interval ) {
        $fileName = $this->time() . "_" . ucwords( $type ) . "_Orders_" . ucwords( $interval ) . ".csv";
        return \Excel::download( new Orders( $type, $interval ), $fileName );
    }

    public function transactions( Request $request, $interval ) {
        $fileName = $this->time() . "_" . ucwords( $interval ) . "_Transaction_History.csv";
        return \Excel::download( new TransactionHistory( $interval ), $fileName );
    }

    // Seller Report Generation
    public function sellerProducts( Request $request, $type, $interval ) {
        $fileName = $this->time() . "_" . ucwords( $type ) . "_Products_" .  ucwords( $interval ) . ".csv";
        return \Excel::download( new SellerProducts( $type, $interval ), $fileName );
    }

    public function sellerRefunds( Request $request, $interval ) {
        $fileName = $this->time() . "_Refunds_" .  ucwords( $interval ) . ".csv";
        return \Excel::download( new SellerRefunds( $interval ), $fileName );
    }

    public function sellerPayouts( Request $request, $interval ) {
        $fileName = $this->time() . "_Payouts_" .  ucwords( $interval ) . ".csv";
        return \Excel::download( new SellerPayouts( $interval ), $fileName );
    }
}
