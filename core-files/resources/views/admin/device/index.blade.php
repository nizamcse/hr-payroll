@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card my-3">
                <div class="header">
                    <h2>Devices List</h2>
                    <ul class="header-dropdown">
                        <li><a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#addDevice">Add New</a></li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                            <thead class="thead-dark">

                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Ip Address</th>
                                <th>Port</th>
                                <th>Device Number</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($devices as $k => $device)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $device->name }}</td>
                                    <td>{{ $device->ip_address }}</td>
                                    <td>{{ $device->port }}</td>
                                    <td>{{ $device->device_no }}</td>
                                    <td class="text-right">
                                        <button data-url="{{ route('update-device',$device->id) }}" class="btn btn-outline-warning btn-sm flat btn-edit" data-toggle="modal" data-target="#editDevice"><i class="fa fa-edit" ></i>Edit</button>
                                        <button data-url="{{ route('delete-device',['id' => $device->id]) }}" class="btn btn-outline-danger btn-sm flat btn-delete" data-toggle="modal" data-target="#delete-content-modal"><i class="fa fa-trash-o"></i> Delete</button>
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
    <div class="modal animated zoomIn" id="addDevice" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('create-device') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">CREATE NEW BONUS</h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Device Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Device IP *</label>
                            <input type="text" class="form-control" name="ip_address" required>
                        </div>
                        <div class="form-group">
                            <label>Port *</label>
                            <input type="text" class="form-control" name="port" required>
                        </div>
                        <div class="form-group">
                            <label>Device Number *</label>
                            <input type="text" class="form-control" name="device_no" required>
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
    <div class="modal animated zoomIn" id="editDevice" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateDevice" action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">UPDATE BONUS</h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Device Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Device IP *</label>
                            <input type="text" class="form-control" name="ip_address" required>
                        </div>
                        <div class="form-group">
                            <label>Port *</label>
                            <input type="text" class="form-control" name="port" required>
                        </div>
                        <div class="form-group">
                            <label>Device Number *</label>
                            <input type="text" class="form-control" name="device_no" required>
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
                        $("#updateDevice").attr('action',url);
                        $("#updateDevice input[name='name']").val(result.name);
                        $("#updateDevice input[name='ip_address']").val(result.ip_address);
                        $("#updateDevice input[name='port']").val(result.port);
                        $("#updateDevice input[name='device_no']").val(result.device_no);
                    }});
            });
        });
    </script>
@endsection