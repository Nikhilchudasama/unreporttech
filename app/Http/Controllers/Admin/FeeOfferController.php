<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\FeeOffer;
use App\CommonFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class FeeOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = "Fee Offer";
        return view('admin.fee_offer.index', compact('name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fee_offer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = request()->validate(FeeOffer::validationRules());
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['status'] = CommonFunctions::checkedCheckbox(request()->input('status'));
        $feeOffer = FeeOffer::create($validatedData);
        return $this->respond('Record added',$feeOffer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FeeOffer  $feeOffer
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $query = FeeOffer::query();
        $query->where('user_id', Auth::user()->id);
        return DataTables::of($query)
        ->addColumn('status', function($feeOffer){
            return $feeOffer->getStatus();
        })
        ->addColumn('action', function ($feeOffer) {
            $html = '';
            $html .= '<a href="javascript:void(0)" data-url="'.route('admin.feeOffer.edit', ['feeOffer' => $feeOffer->id]) .'" class="btn waves-effect waves-light btn-warning btn-icon edit-form-button"><i class="icofont icofont-pen-alt-4"></i></a>';   
            //$html .= '<a href="javascript:void(0)" data-url="' . route('admin.feeOffer.destroy', ['feeOffer' => $feeOffer->id]) . '" class="btn waves-effect waves-light btn-danger btn-icon delete-button"><i class="icofont icofont-trash"></i></a>';
            return $html;
        })
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FeeOffer  $feeOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeOffer $feeOffer)
    {
        return view('admin.fee_offer.edit', compact('feeOffer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FeeOffer  $feeOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeeOffer $feeOffer)
    {
        $validatedData = request()->validate(FeeOffer::validationRules());
        $validatedData['status'] = CommonFunctions::checkedCheckbox(request()->input('status'));
        $feeOffer->update($validatedData);
        return $this->respond('Record updated',$feeOffer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeeOffer  $feeOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeOffer $feeOffer)
    {
        //
    }
}
