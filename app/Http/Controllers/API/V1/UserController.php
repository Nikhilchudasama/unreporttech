<?php

namespace App\Http\Controllers\API\V1;


use Hash;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Authorize a user to access the user's account.
     *
     * @param  Illuminate\Http\Request
     * @return Illuminate\Http\Response
    */

    public function userAttemptLogin(Request $request)
    {
        $user = User::where('email', request()->input('email'))->first();
        if(!$user){
            return $this->respondWithFailure('User not recognize');
        }else{
            if (!Hash::check(request()->input('password'), $user->password)) {
                return $this->respondWithFailure('password not match');
            }else{
                DB::table('oauth_access_tokens')->where('user_id',$customer->id)->delete();
                Auth::login($user);
                $token = $user->createToken('personal')->accessToken;
                $data['token'] =  $token;
                $data['user'] = $user;
                return $this->respond('Login Success', $data);
            }
        }
    }
}
