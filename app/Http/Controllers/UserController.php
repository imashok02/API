<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
     public function follows($username)
      {
          // Find the User. Redirect if the User doesn't exist
          $user = User::where('username', $username)->firstOrFail();

      // Find logged in User
          $id = Auth::id();
          $me = User::find($id);

          $me->following()->attach($user->id);

         // return redirect('/' . $username);

          return response()->json($username);
      }

      

    public function unfollows($username)
      {
          // Find the User. Redirect if the User doesn't exist
          $user = User::where('username', $username)->firstOrFail();

      // Find logged in User
          $id = Auth::id();
          $me = User::find($id);

          $me->following()->detach($user->id);

       //   return redirect('/' . $username);

          return response()->json($username);
      }


    private function responseSuccess($message = '')
    {
      return $this->response(true, $message);
    }

    private function responseFail($message = '')
    {
      return $this->response(false, $message);
    }

    private function response($status = false, $message = '')
    {
      return response()->json([
        'status' => $status,
        'message' => $message,
        ]);
    }



}

    






