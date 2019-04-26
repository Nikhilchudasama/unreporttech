<form role="form" id="edit-form" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('admin.feeOffer.update', ['feeOffer' => $feeOffer->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="sub-title font-weight-bold">Fee Offer Details</h4>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="package_name" class="form-control" value="{{ $feeOffer->package_name }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">Package Name</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="start_date" class="form-control datepicker1" value="{{ $feeOffer->start_date }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">Start Date</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="end_date" class="form-control datepicker1" value="{{ $feeOffer->end_date }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">End Date</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="fee" class="form-control" value="{{ $feeOffer->fee }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">Fee</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="discount" class="form-control" value="{{ $feeOffer->discount }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">Discount</label>
                </div>
            </div>
            <div class="col-sm-3">
                    <label class="form-label">Status</label>
                    <input type="checkbox" name="status" class="js-switch1 form-control" {{ $feeOffer->status?'checked':'' }}/>
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
