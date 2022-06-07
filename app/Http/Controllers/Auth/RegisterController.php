<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\UserValidId;
use DB;
use App\adminNotifModel;
use Auth;
class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;




    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile' => ['required', 'regex:/^[0-9]{11}+$/']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {

        $request = request();

        $valid_idImage = $request->file('valid_id');
        $valid_idImageSaveAsName = time() . uniqid() . "-valid_id." . $valid_idImage->getClientOriginalExtension();

        $upload_path = 'storage/user-valid-ids/' . date('FY') . '/';
        $upload_path_url = 'user-valid-ids\\' . date('FY') . '\\';
        $valid_id_image_url = $upload_path_url . $valid_idImageSaveAsName;

        $success = $valid_idImage->move($upload_path, $valid_idImageSaveAsName);
        $getLastInsertedUserId = DB::table('users')->latest('id')->first()->id + 1;

        $valid_id_obj = new UserValidId();
        $valid_id_obj->valid_id_path = $valid_id_image_url;
        // change valid id obj to valid 
        // changelog change is valid to 2 for pending
        $valid_id_obj->is_valid = '2';
        $valid_id_obj->user_email = $data['email'] ;
        $valid_id_obj->user_id = $getLastInsertedUserId;
        $valid_id_obj->save();
    
        // notify admin that the user registers
        $adminnotif_ent = new adminNotifModel();
        $adminnotif_ent->action_type = 'User regisration';
        $adminnotif_ent->user_id = $getLastInsertedUserId;
        $adminnotif_ent->action_description = $data['name'] . 'register a new account with an email:' . $data['email'];
        $adminnotif_ent->save();  

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_name' => 'null',
            'IsdefaultPassword' => '1',
            'role_id' => '2',
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'mobile' => $data['mobile'],
            'province' => $data['province'],
            'barangay' => $data['barangay'],
            'bday' => $data['bday'],
            'town' => $data['town'],
            // 'valid_id' => $valid_id_image_url,

        ]);

        

//        return redirect()->route('home')->withMessage('Please login to your account');
           return view('auth.verify');
    }
}
