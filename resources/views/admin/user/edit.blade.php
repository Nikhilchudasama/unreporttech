<form role="form" id="edit-form" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('admin.user.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
                        <option value="{{ $branch->id }}" {{ $user->branch_id == $branch->id?'selected':''  }}>{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">Name</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-default">
                    <input type="text" name="mobile" class="form-control"  maxlength="10" value="{{ $user->mobile }}" required>
                    <span class="form-bar"></span>
                    <label class="float-label">Mobile No</label>
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
                    <label class="form-label">Status</label>
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
        });
    </script>
</form>
