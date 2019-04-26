<form role="form" id="edit-form" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('admin.setting.update', ['setting' => $setting->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="sub-title font-weight-bold">Setting Details</h4>
            </div>
            <div class="col-sm-6">
                <div class="form-group form-default">
                    <select name="academic_year_id" id="academic_year_id" class="form-control form-default" required>
                        <option value="">Select Year</option>
                        @foreach($academicYears as $academicYear)
                        <option value="{{ $academicYear->id }}" {{ $setting->academic_year_id == $academicYear->id?'selected':''  }}>{{ $academicYear->title.' '.$academicYear->start_date->format('d-M-Y').' to '.$academicYear->end_date->format('d-M-Y') }}</option>
                        @endforeach
                    </select>
                </div>
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
        });
    </script>
</form>
