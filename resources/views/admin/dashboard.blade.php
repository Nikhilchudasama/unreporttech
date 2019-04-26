@extends('admin.layouts.master', ['page' => 'Dashboard'])

@section('title', 'Dashboard')

@section('dashboard')

        {{--<div class="col-12 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-blue">1</h4>
                            <h6 class="text-muted m-b-0">NSE:NIFTY</h6>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0"></p>
                        </div>
                        <div class="col-3 text-right">
                            <a href="#">
                                <i class="feather icon-trending-up text-white f-16"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-blue">2</h4>
                            <h6 class="text-muted m-b-0">BSE:SENSEX</h6>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0"></p>
                        </div>
                        <div class="col-3 text-right">
                            <a href="#">
                                <i class="feather icon-trending-up text-white f-16"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}

        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-blue">1</h4>
                            <h6 class="text-muted m-b-0">Booked</h6>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0"></p>
                        </div>
                        <div class="col-3 text-right">
                        <a href="#">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-blue">2</h4>
                            <h6 class="text-muted m-b-0">On The Way</h6>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0"></p>
                        </div>
                        <div class="col-3 text-right">
                            <a href="#">
                                <i class="feather icon-trending-up text-white f-16"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-blue">3</h4>
                            <h6 class="text-muted m-b-0">Branch Receive</h6>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0"></p>
                        </div>
                        <div class="col-3 text-right">
                        <a href="#">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-blue">4</h4>
                            <h6 class="text-muted m-b-0">Dispatch</h6>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0"></p>
                        </div>
                        <div class="col-3 text-right">
                            <a href="#">
                                <i class="feather icon-trending-up text-white f-16"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('js/Sortable.js') }}"></script>
<script>
    $( function() {
        $( "#draggablePanelList" ).sortable({
            revert: true,
            animation:150
        });
    });
</script>
@endpush