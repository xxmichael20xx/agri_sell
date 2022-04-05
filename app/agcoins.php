<?php
// agrisell coins adapter class
// includes
// get agcoins
namespace App;
use DB;
use Auth;
use App\coinsTopUpEmployeeEntry;
class agcoins 
{
     public static function getAgCoins(){
        $total_ag_coins = 0;

        $curr_ag_coins_insts = DB::table('coins_top_up')->where('user_id', Auth::id())->where('remarks', '1')->get();
        foreach($curr_ag_coins_insts as $curr_ag_coins_obj){
        $total_ag_coins += $curr_ag_coins_obj->value;
        }
        $total_ag_coins_deduct = 0;
        $ag_coins_trans_insts = DB::table('coins_transaction')->where('user_id', Auth::id())->get();
        foreach($ag_coins_trans_insts as $ag_coins_trans_obj){
            $total_ag_coins_deduct += $ag_coins_trans_obj->value;
            $total_ag_coins = $total_ag_coins - $ag_coins_trans_obj->value;
        }

        if($total_ag_coins < 0){
            $total_ag_coins = 'invalid';
        }
        return $total_ag_coins;
    }

    public static function reflect_amount($trans_id){
        DB::table('coins_top_up')->where('id', $trans_id)->update(['remarks' => 1]);
        return back();
    }

    // perform this because you don't know if the user will encode the coins first or the employee
    // performas automatico coins validatos por que tu no saber Si user sera primero codificar la coins top up o coins empleyado
    public static function coins_auto_top_validate(){
        $coinsTopUps_entities = coinsTopUpEmployeeEntry::all();
        foreach($coinsTopUps_entities as $coinsTopUps_entity){
            //coins top up entity update temp
            $coinsTopUps_entity_temp_obj = coinsTopUpEmployeeEntry::find($coinsTopUps_entity->id);
            // coins top up for conditional statements
            $coins_trans_type_temp = $coinsTopUps_entity->coins_trans_type;
            $coins_trans_type_temp_user = $coinsTopUps_entity->coins_top_up->coins_trans_type ?? 'not available';
            $coins_value_temp = $coinsTopUps_entity->value;
            $coins_value_temp_user = $coinsTopUps_entity->coins_top_up->value ?? 0;
            $coins_trans_id_temp = $coinsTopUps_entity->cust_trans_id;
            $coins_trans_id_temp_user = $coinsTopUps_entity->coins_top_up->trans_id ?? 'not available';
            
            // coins top up conditionals
            if($coins_trans_type_temp == $coins_trans_type_temp_user){
                if($coins_value_temp == $coins_value_temp_user){
                    if($coins_trans_id_temp == $coins_trans_id_temp_user){
                        // performa accepted update database     
                        
                        $coinsTopUps_entity_temp_obj->status = 'accepted';
                        $coinsTopUps_entity_temp_obj->save();

                        // altera remarks 1 coins top up
                        $coins_top_up_entity_obj = coinsTopUpModel::where('trans_id', $coinsTopUps_entity_temp_obj->cust_trans_id)->first();
                        $coins_top_up_entity_obj->remarks = 1;
                        $coins_top_up_entity_obj->save();
                    }else{
                        $coinsTopUps_entity_temp_obj->status = 'denied';
                        $coinsTopUps_entity_temp_obj->save();
                    }
                }else{
                    $coinsTopUps_entity_temp_obj->status = 'denied';
                    $coinsTopUps_entity_temp_obj->save();
                }
            }else{
                $coinsTopUps_entity_temp_obj->status = 'denied';
                $coinsTopUps_entity_temp_obj->save();
            }
            
        }

    }    
}
