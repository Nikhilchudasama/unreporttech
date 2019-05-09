@extends('admin.layouts.master', ['page' => $name])
@section('title', $name)
@push('styles')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/switchery.min.css') }}">
<style>
	#users-table_filter {
		width: 70%;
		padding: 0 1% 0 6%;
	}

	#users-table_filter label {
		width: 100%;
	}
</style>
@endpush
@section('contents')
<div class="card">
	<div class="card-header">
		<h5>{{ $name }}</h5>
	</div>
	<div class="delete-button"></div>
	<div class="card-block table-border-style">
    <form role="form"  autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('admin.feestore') }}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="sub-title font-weight-bold">Student Fees</h4>
                </div>
                <input type="hidden" name="student_id"  value="{{ $student_id }}">
                <div class="col-sm-6">
                    <div class="form-group form-default">
                        <input type="text" name="paid" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Fee</label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <a href="{{ route('admin.getFeeHistory', ['student_id' => $student_id]) }}" type="button" class="btn btn-primary waves-effect">Back</a>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                </div>
            </div>
    </form>

	</div>
</div>
</div>

@endsection
@push('scripts')
@endpush