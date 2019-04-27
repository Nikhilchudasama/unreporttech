<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Branch;
use App\Setting;
use App\CommonFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = "User";
        return view('admin.user.index', compact('name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::where('user_id', Auth::user()->id)->get();
        return view('admin.user.add', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = request()->validate(User::validationRulesForSubUser());
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['active'] = CommonFunctions::checkedCheckbox(request()->input('active'));
        $validatedData['user_id'] = Auth::user()->id;
        $user = User::create($validatedData);
        return $this->respond('Record added',$user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $query = User::query();
        $query->where('is_admin', 0)->where('user_id', Auth::user()->id);
        return DataTables::of($query)
        ->addColumn('active', function ($user) {
            return $user->getStatus();
        })

        ->addColumn('action', function ($user) {
            $html = '';
            $html = '';
            $html .= '<a href="javascript:void(0)" data-url="'.route('admin.user.edit', ['user' => $user->id]) .'" class="btn waves-effect waves-light btn-warning btn-icon edit-form-button"><i class="icofont icofont-pen-alt-4"></i></a>   <a href="javascript:void(0)" data-url="' . route('admin.user.change-password', ['user' => $user->id]) . '" class="btn waves-effect waves-light btn-info btn-icon change-password"><i class="icofont icofont-key"></i></a>';
            // $html .='<a href="javascript:void(0)" data-url="' . route('admin.user.destroy', ['user' => $user->id]) . '" class="btn waves-effect waves-light btn-danger btn-icon delete-button"><i class="icofont icofont-trash"></i></a>  ';
            return $html;
        })
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $branches = Branch::where('user_id', Auth::user()->id)->get();
        return view('admin.user.edit', compact('branches','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = request()->validate(User::validationRulesForSubUser($user->id));
        $validatedData['active'] = CommonFunctions::checkedCheckbox(request()->input('active'));
        $user->update($validatedData);
        return $this->respond('Record updated',$user);
    }

    /**
     * Remove the specified resource from storage soft.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $user->branch()->delete();
        // $user->delete();
    }

    /**
     * update user Password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     **/
    public function updatePassword()
    {
        $validatedData = request()->validate(User::passwordValidationRules());
        $user = Auth::guard('web')->user();

        if (Hash::check(request('old_password'), $user->password)) {
            $user->password = bcrypt(request('password'));
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password update.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Incorrect current password.'
        ]);
    }

    /**
     * update user password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    **/
    public function changePassword()
    {
        $password = bcrypt(request()->input('password'));
        $user = request()->get('user');
        $findUser = User::findorfail($user);
        $findUser->password = $password;
        $findUser->save();
        return $this->respond('update password', $findUser);
    }
}
