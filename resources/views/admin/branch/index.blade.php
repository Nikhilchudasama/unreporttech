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
		<button type="button" data-url="{{ route('admin.branch.create') }}" class="btn btn-primary waves-effect float-right" id="add-form-btn">Add Branch</button>
	</div>
	<div class="delete-button"></div>
	<div class="card-block table-border-style">
		<div class="table-responsive">
			<table class="table" id="users-table">
				<thead>
					<tr>
						<th class="d-none">ID</th>
						<th>No</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
</div>

@endsection 
@push('scripts')
<script src="{{ asset('js/datatable.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/switchery.min.js') }}" type="text/javascript"></script>
<script>
	$(function() {
		$('#users-table').DataTable({
			responsive: true,
			order: [
				[0, 'desc']
			],
			lengthMenu: [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			processing: true,
			serverSide: true,
			oLanguage: {
				"sSearch": ""
			},
			ajax: '{{ route("admin.branch.userdata") }}',
			columns: [{
					data: 'id',
					name: 'id',
					class: 'd-none',
					orderable: false,
					searchable: false
				},
				{
					data: 'DT_RowIndex',
					name: 'DT_RowIndex',
					orderable: false,
					searchable: false
				},
				{
					data: 'name',
					name: 'name',
					sortable: false,
				},
				{ 
					data: 'action', 
					name: 'action', 
					sortable: false, 
				},
			],
		});
		$('input[type="search"]').addClass('form-control');
		$('input[type="search"]').attr('placeholder', 'Search');

	});
</script>
@endpush