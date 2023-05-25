<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function getLoginForm(){
        return view('login.index');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Oops! '.$validator->errors()->first(), 'status' => 1]);
        }else{
            try{
                if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                    return response()->json(['message' => 'Login Failed. Credentials did not match with our records.', 'status' => 0 ]);
                }else{
                    return response()->json(['message' => 'Login Successfull.', 'url' => 'view/dashboard', 'status' => 1 ]);
                }
            }catch(\Exception $e){
                return response()->json(['message' => 'Oops! Something Went Wrong', 'status' => 0]);
            }
        }
    }

    public function logout(Request $request){
        
        Session::flush();
        Auth::logout();
        return redirect('/admin-login');
    }
}