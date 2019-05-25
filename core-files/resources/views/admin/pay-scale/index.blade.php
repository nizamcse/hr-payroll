@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card my-3">
                <div class="header">
                    <h2>Pay Scale List</h2>
                    <ul class="header-dropdown">
                        <li><a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#addPayScale">Add New</a></li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                            <thead class="thead-dark">

                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Basic</th>
                                <th>House Rent</th>
                                <th>Convey</th>
                                <th>Medical</th>
                                <th>Food</th>
                                <th>OT Salary</th>
                                <th>Att Bonus</th>
                                <th>Gross</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pay_scales as $k => $pay_scale)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $pay_scale->name }}</td>
                                    <td>{{ $pay_scale->basic }}</td>
                                    <td>{{ $pay_scale->house_rent }}</td>
                                    <td>{{ $pay_scale->medical }}</td>
                                    <td>{{ $pay_scale->convey }}</td>
                                    <td>{{ $pay_scale->food }}</td>
                                    <td>{{ $pay_scale->ot_salary_per_hour }}</td>
                                    <td>{{ $pay_scale->att_bonus }}</td>
                                    <td>{{ $pay_scale->gross_salary }}</td>
                                    <td class="text-right">
                                        <button data-url="{{ route('update-pay-scale',$pay_scale->id) }}" class="btn btn-outline-warning btn-sm flat btn-edit" data-toggle="modal" data-target="#editPayScale"><i class="fa fa-edit" ></i>Edit</button>
                                        <button data-url="{{ route('delete-pay-scale',['id' => $pay_scale->id]) }}" class="btn btn-outline-danger btn-sm flat btn-delete" data-toggle="modal" data-target="#delete-content-modal"><i class="fa fa-trash-o"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animated zoomIn" id="addPayScale" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('create-pay-scale') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">CREATE NEW PAY SCALE</h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Scale Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Basic Salary</label>
                                    <input type="text" name="basic" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>House Rent</label>
                                    <input type="text" name="house_rent" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Medical</label>
                                    <input type="text" name="medical" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Convey</label>
                                    <input type="text" name="convey" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Food</label>
                                    <input type="text" name="food" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>OT Salary</label>
                                    <input type="text" name="ot_salary_per_hour" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Att Bonus</label>
                                    <input type="text" name="att_bonus" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">CREATE</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal animated zoomIn" id="editPayScale" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateDesignation" action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">UPDATE PAY SCALE</h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Scale Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Basic Salary</label>
                                    <input type="text" name="basic" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>House Rent</label>
                                    <input type="text" name="house_rent" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Medical</label>
                                    <input type="text" name="medical" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Convey</label>
                                    <input type="text" name="convey" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Food</label>
                                    <input type="text" name="food" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>OT Salary</label>
                                    <input type="text" name="ot_salary_per_hour" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Att Bonus</label>
                                    <input type="text" name="att_bonus" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click','.btn-edit',function(){
                var url = $(this).data('url');
                $.ajax({url: url, success: function(result){
                        $("#updateDesignation").attr('action',url);
                        $("#updateDesignation input[name='name']").val(result.name);
                        $("#updateDesignation input[name='basic']").val(result.basic);
                        $("#updateDesignation input[name='house_rent']").val(result.house_rent);
                        $("#updateDesignation input[name='convey']").val(result.convey);
                        $("#updateDesignation input[name='medical']").val(result.medical);
                        $("#updateDesignation input[name='food']").val(result.food);
                        $("#updateDesignation input[name='ot_salary_per_hour']").val(result.ot_salary_per_hour);
                        $("#updateDesignation input[name='att_bonus']").val(result.att_bonus);
                    }});
            });
        });
    </script>
@endsection