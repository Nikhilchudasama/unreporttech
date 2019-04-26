    <form role="form" id="add-form" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('super_admin.user.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="sub-title font-weight-bold">User Details</h4>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="text" name="first_name" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">First Name</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="text" name="last_name" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Last Name</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="text" name="email" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Email</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="password" name="password" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Password</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="password" name="password_confirmation" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Password Confirmation</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Active</label>
                    <input type="checkbox" name="active" class="js-switch form-control"/>
                </div>
            </div>
        </div>
        <script>
        var elem = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

		elem.forEach(function(html) {
			var switchery = new Switchery(html, {
				color: '#4099ff',
				jackColor: '#fff'
			});
		});
        </script>
        @include('admin.layouts.includes.common_popup_footer')
    </form>
