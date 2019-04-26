    <form role="form" id="add-form" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('admin.branch.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="sub-title font-weight-bold">Branch Details</h4>
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
                        <textarea name="address" class="form-control" required></textarea>
                        <span class="form-bar"></span>
                        <label class="float-label">Address</label>
                    </div>
                </div>
                {{-- <div class="col-sm-3">
                    <label class="form-label">Status</label>
                    <input type="checkbox" name="status" class="js-switch form-control"/>
                </div> --}}
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
