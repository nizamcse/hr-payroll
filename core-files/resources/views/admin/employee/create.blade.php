@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card my-3">
                <div class="header">
                    <h5>Create New Employee <a href="{{ route('employees') }}" class="btn btn-sm btn-info pull-right">Employee List</a></h5>
                </div>
                <!-- /.panel-heading -->
                <div class="body">
                    <form action="{{ route('store-employee') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name *</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <select name="designation_id" class="form-control">
                                                <option value="">Select Designation</option>
                                                @foreach($designations as $designation)
                                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select name="branch_id" class="form-control">
                                                <option value="">Select Branch</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pay Scale</label>
                                            <select name="pay_scale_id" class="form-control">
                                                <option value="">Select Pay Scale</option>
                                                @foreach($pay_scales as $pay_scale)
                                                    <option value="{{ $pay_scale->id }}">{{ $pay_scale->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Section</label>
                                            <select name="section_id" class="form-control">
                                                <option value="">Select Section</option>
                                                @foreach($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Line</label>
                                            <select name="line_id" class="form-control">
                                                <option value="">Select Line</option>
                                                @foreach($lines as $line)
                                                    <option value="{{ $line->id }}">{{ $line->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contact No *</label>
                                            <input type="text" class="form-control" name="contact_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>In Time</label>
                                            <date-time :inputs="{format: 'HH:mm',name: 'in_time' }"></date-time>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Exit Time</label>
                                            <date-time :inputs="{format: 'HH:mm',name: 'exit_time' }"></date-time>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Salary Type</label>
                                            <select name="salary_type" class="form-control" required>
                                                <option value="">Select Salary Type</option>
                                                <option value="1">Hourly</option>
                                                <option value="2">Monthly</option>
                                                <option value="3">Production Base</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Shift</label>
                                            <select name="shift" class="form-control">
                                                <option value="0">Day</option>
                                                <option value="1">Night</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employee ID</label>
                                            <input type="text" name="employee_id" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <div class="form-group m-0">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="count_ot">
                                                <span>Allow OT</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-4 d-flex align-items-center">
                                        <div class="form-group m-0">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="attendance_bonus">
                                                <span>Allow Attendance Bonus</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-sm btn-info">Create Employee</button>
                        </div>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection


@section('styles')
@endsection


@section('script')
    <script src="{{ asset('core-files/public/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#photo").change(function() {
                console.log("fired");
                readURL(this);
            });
        });
    </script>
@endsection
