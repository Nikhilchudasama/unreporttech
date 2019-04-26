    <form role="form" id="add-form" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('admin.feeOffer.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="sub-title font-weight-bold">Fee Offer Details</h4>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="text" name="package_name" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Package Name</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="text" name="start_date" class="form-control datepicker1" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Start Date</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="text" name="end_date" class="form-control datepicker1" required>
                        <span class="form-bar"></span>
                        <label class="float-label">End Date</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="text" name="fee" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Fee</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="text" name="discount" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Discount</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Status</label>
                    <input type="checkbox" name="status" class="js-switch form-control"/>
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
        $('.datepicker1').datepicker({
                format: 'yyyy-mm-dd',
            autoclose: true,
        }).on('change', function(){
            updateFormInput();
        });
        </script>
        @include('admin.layouts.includes.common_popup_footer')
    </form>
