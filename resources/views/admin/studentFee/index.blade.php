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
		<a href="{{ route('admin.addFee',['student_id' => $student_id]) }}" class="btn btn-primary waves-effect float-right">Add Fee</a>
		<a href="{{ route('admin.student.index') }}" class="btn btn-primary waves-effect float-right mr-5">Back</a>
	</div>
	<div class="delete-button"></div>
	<div class="card-block table-border-style">
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Paid Fee</th>
						<th>Unpaid Fee</th>
						<th>Pay Date</th>
					</tr>
                </thead>
                <tbody>
                    @foreach($feeRecords as $record)
                    <tr>
                        <td>{{ $record->paid }}</td>
                        <td>{{ $record->unpaid }}</td>
                        <td>{{ $record->created_at->format('d-m-Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
			</table>
		</div>
	</div>
</div>
</div>

@endsection
@push('scripts')
@endpush