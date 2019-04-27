<?php

namespace App\Http\Controllers\API\V1;

use DB;
use Hash;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\BranchCollection;

class UserController extends ApiController
{
    /**
     * Authorize a user to access the user's account.
     *
     * @param  Illuminate\Http\Request
     * @return Illuminate\Http\Response
    */

    public function userAttemptLogin(Request $request)
    {
        if($this->checkHeader() == null){
            $user = User::where('mobile', request()->input('mobile'))->first();
            if(!$user){
                $this->statusCode = 404;
                return $this->respondWithFailureApi('User not recognize');
            }else{
                if (!Hash::check(request()->input('password'), $user->password)) {
                    $this->statusCode = 404;
                    return $this->respondWithFailureApi('password not match');
                }else{
                    if($user->active != true){
                        $this->statusCode = 406;
                        return $this->respondWithFailureApi('Your Account Deactivate');
                    }
                    DB::table('oauth_access_tokens')->where('user_id',$user->id)->delete();
                    Auth::login($user);
                    $token = $user->createToken('personal')->accessToken;
                    $data['token'] =  $token;
                    $data['user'] = new UserResource($user);
                    return $this->respondApi('Login Success', $data);
                }
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Branch List
     *
     * @return mixed|array
    */
    public function branchList(Request $request){
        if($this->checkHeader() == null){
            $branch = new BranchCollection(request()->user()->branch);
            return $this->respondApi('Branch List', ['branch' => $branch]);
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Forget Password
     *
     * @param string $mobile mobile no
     * @return type
     **/
    public function forgetPassword(Request $request)
    {
        if($this->checkHeader() == null){
            $user = User::where('mobile', request()->input('mobile'))->first();
            if($user){
                return $this->respondApi('success');
            }

            $this->statusCode = 422;
            return $this->respondWithFailureApi('This mobile not registered');
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Update Password
     *
     * @param string $mobile Mobile NO
     * @param string $password Password
     * @return array
     **/
    public function updatePassword(Request $request)
    {
        if($this->checkHeader == null){
            $password = bcrypt(request()->input('password'));
            $user = User::where('mobile', request()->input('mobile'))->update(['password' =>  $password]);
            if($user){
                return $this->respondApi('password updated');
            }
            $this->statusCode= 400;
            return $this->respondWithFailureApi('This mobile not registered');
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    // ========================= User Related Method Start ====================== //

    /**
     * User List
     *
     * @return mixed|array
     **/
    public function userList(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $userList = User::userList(request()->user()->id, request()->input('offset'), request()->input('search'));
                return $this->respondApi('users', new UserCollection($userList));
            }else{
                $this->statusCode= 403;
                return $this->respondWithFailureApi('Forbidden');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Create User
     *
     * @param  Illuminate\Http\Request
     * @return mixed|array
     **/
    public function createUser(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $validate = Validator::make($request->all(), [
                    'branch_id' => 'required',
                    'name' => 'required|string|max:255',
                    'mobile' => 'required|numeric|unique:users',
                    'password' => 'required|string|min:6',
                ]);
                if ($validate->fails()) {
                    $this->statusCode = 422;
                    return $this->respondWithFailureApi('Validation error', $validate->errors());
                }
                $validatedData = request()->all();
                $validatedData['password'] = bcrypt($validatedData['password']);
                $validatedData['user_id'] = request()->user()->id;
                $user = User::create($validatedData);
                return $this->respondApi('User created');
            }else{
                $this->statusCode= 403;
                return $this->respondWithFailureApi('Forbidden');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Update User
     *
     *
     * @param  Illuminate\Http\Request
     * @return mixed|array
     **/
    public function updateUser(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $validate = Validator::make($request->all(), [
                    'branch_id' => 'required',
                    'name' => 'required|string|max:255',
                ]);

                if ($validate->fails()) {
                    $this->statusCode = 422;
                    return $this->respondWithFailureApi('Validation Error', $validate->errors());
                }
                $validatedData = request()->all();
                unset($validatedData['uid']);
                $user = User::where('id', request()->input('uid'))->update($validatedData);
                return $this->respondApi('User updated');
            }else{
                $this->statusCode= 403;
                return $this->respondWithFailureApi('Forbidden');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    //==================== User End  =========================//
}
