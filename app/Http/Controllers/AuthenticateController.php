<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
 
use Illuminate\Support\Facades\Hash;
 
use Illuminate\Http\Request;
 
use App\User;
 
class AuthenticateController extends Controller
 
{
 
  public function __construct()
 
   {
 
     //  $this->middleware('auth:api');
 
   }
 
   /**
 
    * Display a listing of the resource.
 
    *
 
    * @return \Illuminate\Http\Response
 
    */
 
   public function authenticate(Request $request)
 
   {
 
       $this->validate($request, [
 
       'email' => 'required',
 
       'password' => 'required'
 
        ]);
 
      $user = User::where('email', $request->input('email'))->first();
 
     if(Hash::check($request->input('password'), $user->password)){
 
          $apikey = base64_encode(str_random(40));
 
          User::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);;
 
          return response()->json(['status' => 'success','api_key' => $apikey]);
 
      }else{
 
          return response()->json(['status' => 'fail'],401);
 
      }
 
   }




    public function register(Request $request)
    {
      $this->validate($request,array(
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',  
            ));


      $user = new User();

      $user->name =$request->name;
      $user->username =$request->username;
      $user->email =$request->email;
      $user->password = Hash::make($request->password);
      $user->api_key = base64_encode(str_random(60));

      $user->save();

      return $user;


    }

    public function logout(Request $request) 
    {
      $api_key = $request->api_key;
      $user = User::where('api_key', $api_key)->first();

      if(!$user)
      {
        return response()->json(['status'=>'failed'], 401);

      }

      $user->api_key = null;

      $user->save();

      return response()->json(["You have been logged out"]);
    }
 
}    
 
?>