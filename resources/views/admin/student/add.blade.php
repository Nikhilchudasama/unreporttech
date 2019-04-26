    <form role="form" id="add-form" autocomplete="off" enctype="multipart/form-data" class="form-material" method="post"  action="{{ route('admin.student.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="sub-title font-weight-bold">Student Details</h4>
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
                        <input type="text" name="first_name" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">First Name</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="text" name="middle_name" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Middle Name</label>
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
                        <input type="text" name="mobile_no" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Mobile No</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-default">
                        <input type="file" name="student_image" class="form-control">
                        <span class="form-bar"></span>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.includes.common_popup_footer')
    </form>
