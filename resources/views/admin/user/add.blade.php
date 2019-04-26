    <form role="form" id="add-form" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('admin.subUser.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="sub-title font-weight-bold">User Details</h4>
                </div>
                <div class="col-sm-3">
                     <div class="form-group form-default">
                        <select name="branch_id" id="branch_id" class="form-control form-default" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="text" name="name" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Name</label>
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
                    <label class="form-label">Status</label>
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
