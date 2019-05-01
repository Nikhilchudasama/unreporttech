
@extends('admin.layouts.master', ['page' => $name])
@section('title', $name)
@section('contents')
<div class="card">
    <div class="card-header">
        <h5 class="card-header-text">Setting</h5>
        <button id="edit-btn" type="button" data-url="{{ route('admin.setting.edit', ['setting' => Auth::user()->setting->id]) }}" class="btn btn-sm btn-primary waves-effect waves-light float-right edit-form-button">
                <i class="icofont icofont-edit"></i>
        </button>
    </div>
    <div class="card-block">
        <div class="view-info">
            <div class="row">
                <div class="col-lg-12">
                    <div class="general-info">
                        <div class="row">
                            <div class="col-lg-12 col-xl-6">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Academic Year</th>
                                                <td>
                                                @if($setting->academic_year_id != null)
                                                {{ $setting->academicYear->title.' '.date('d-M-Y', strtotime($setting->academicYear->start_date)).' to '.date('d-M-Y', strtotime($setting->academicYear->end_date)) }}
                                                @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="col-lg-12 col-xl-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row"></th>
                                                <td><a href="#!">Demo@example.com</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mobile Number</th>
                                                <td>(0123) - 4567891</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Twitter</th>
                                                <td>@xyz</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Skype</th>
                                                <td>demo.skype</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Website</th>
                                                <td><a href="#!">www.demo.com</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
