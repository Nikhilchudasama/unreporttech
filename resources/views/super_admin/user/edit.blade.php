<form role="form" id="edit-form" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('super_admin.user.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="sub-title font-weight-bold">User Details</h4>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">First Name</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">Last Name</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="email" class="form-control" value="{{ $user->email }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">Email</label>
                </div>
            </div>
            <div class="col-sm-3">
                    <label class="form-label">Active</label>
                    <input type="checkbox" name="active" class="js-switch1 form-control" {{ $user->active?'checked':'' }}/>
            </div>
        </div>
    </div>
    @include('admin.layouts.includes.common_popup_footer')
    <script>
        $(document).ready(function () {
            // Multiple swithces
            var elem = Array.prototype.slice.call(document.querySelectorAll('.js-switch1'));

            elem.forEach(function(html) {
                var switchery = new Switchery(html, { color: '#4099ff', jackColor: '#fff' });
            });
            $('.datepicker1').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            }).on('change', function(){
                updateFormInput();
            });
        });
    </script>
</form>
