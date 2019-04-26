<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = "Branch";
        return view('admin.branch.index', compact('name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branch.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = request()->validate(Branch::validationRules());
        $validatedData['user_id'] = Auth::user()->id;
        $branch = Branch::create($validatedData);
        return $this->respond('Record added',$branch);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $query = Branch::query();
        $query->where('user_id', Auth::user()->id);
        return DataTables::of($query)

        ->addColumn('action', function ($branch) {
            $html = '';
            $html .= '<a href="javascript:void(0)" data-url="'.route('admin.branch.edit', ['branch' => $branch->id]) .'" class="btn waves-effect waves-light btn-warning btn-icon edit-form-button"><i class="icofont icofont-pen-alt-4"></i></a>';   
            //$html .= '<a href="javascript:void(0)" data-url="' . route('admin.branch.destroy', ['branch' => $branch->id]) . '" class="btn waves-effect waves-light btn-danger btn-icon delete-button"><i class="icofont icofont-trash"></i></a>';
            return $html;
        })
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('admin.branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $validatedData = request()->validate(Branch::validationRules());
        $branch->update($validatedData);
        return $this->respond('Record updated',$branch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch  $branch)
    {
        $branch->delete();
    }
}
