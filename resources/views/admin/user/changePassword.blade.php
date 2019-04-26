<div id="add-form-changePassword" class="d-none">
    <form role="form" id="add-changePassword" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post" data-url=""  action="">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-default">
                        <input type="password" name="password" class="form-control" id="cpassword">
                        <span class="form-bar"></span>
                        <label class="float-label">Enter Password</label>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.includes.common_popup_footer')
    </form>
</div>