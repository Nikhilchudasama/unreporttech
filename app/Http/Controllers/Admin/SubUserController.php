<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Branch;
use App\SubUser;
use App\CommonFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SubUserController extends Controller
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
        $validatedData = request()->validate(SubUser::validationRules());
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['status'] = CommonFunctions::checkedCheckbox(request()->input('status'));
        $validatedData['user_id'] = Auth::user()->id;
        $subUser = SubUser::create($validatedData);
        return $this->respond('Record added',$subUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubUser  $subUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $query = SubUser::query();

        return DataTables::of($query)
        ->addColumn('active', function ($subUser) {
            return $subUser->getStatus();
        })

        ->addColumn('action', function ($subUser) {
            $html = '';
            $html .= '<a href="javascript:void(0)" data-url="'.route('admin.subUser.edit', ['subUser' => $subUser->id]) .'" class="btn waves-effect waves-light btn-warning btn-icon edit-form-button"><i class="icofont icofont-pen-alt-4"></i></a>   <a href="javascript:void(0)" data-url="' . route('admin.subUser.change-password', ['subUser' => $subUser->id]) . '" class="btn waves-effect waves-light btn-info btn-icon change-password"><i class="icofont icofont-key"></i></a>';
            // $html .='<a href="javascript:void(0)" data-url="' . route('admin.subUser.destroy', ['subUser' => $subUser->id]) . '" class="btn waves-effect waves-light btn-danger btn-icon delete-button"><i class="icofont icofont-trash"></i></a>  ';
            return $html;
        })
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubUser  $subUser
     * @return \Illuminate\Http\Response
     */
    public function edit(SubUser $subUser)
    {
        $branches = Branch::where('user_id', Auth::user()->id)->get();
        return view('admin.user.edit', compact('branches','subUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubUser  $subUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubUser  $subUser)
    {
        $validatedData = request()->validate(SubUser::validationRules($subUser->id));
        $validatedData['active'] = CommonFunctions::checkedCheckbox(request()->input('active'));
        $subUser->update($validatedData);
        return $this->respond('Record updated',$subUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubUser  $subUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubUser  $subUser)
    {
        dd($subUser);
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
        $id = request()->get('subUser');
        $user = SubUser::findorfail($id);
        $user->password = $password;
        $user->save();
        return $this->respond('update password', $user);
    }
}
