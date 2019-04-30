<form role="form" id="edit-form" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('super_admin.appversion.update', ['appversion' => $appversion->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="sub-title font-weight-bold">App Version Details</h4>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="android" class="form-control" value="{{ $appversion->android }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">Android Version</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="ios" class="form-control" value="{{ $appversion->ios }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">IOS Version</label>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.includes.common_popup_footer')
</form>
