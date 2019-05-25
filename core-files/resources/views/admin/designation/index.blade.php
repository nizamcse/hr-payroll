@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    @include('partials.header',['title' => 'List Of Companies'])
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Designation List</h2>
                    <ul class="header-dropdown">
                        <li><a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#addDesignation">Add New</a></li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                            <thead class="thead-dark">

                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($designations as $k => $designation)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $designation->name }}</td>
                                    <td>{{ $designation->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="text-right">
                                        <button data-url="{{ route('update-designation',$designation->id) }}" class="btn btn-outline-warning btn-sm flat btn-edit" data-toggle="modal" data-target="#editDesignation"><i class="fa fa-edit" ></i>Edit</button>
                                        <button data-url="{{ route('delete-designation',['company_id' => Request::segment(2),'id' => $designation->id]) }}" class="btn btn-outline-danger btn-sm flat btn-delete" data-toggle="modal" data-target="#delete-content-modal"><i class="fa fa-trash-o"></i> Delete</button>
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
    <div class="modal animated zoomIn" id="addDesignation" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('create-designation') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">CREATE NEW DESIGNATION</h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Designation Name *</label>
                            <input type="text" class="form-control" name="name" required>
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
    <div class="modal animated zoomIn" id="editDesignation" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateDesignation" action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">UPDATE DESIGNATION</h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Designation Name *</label>
                            <input type="text" class="form-control" name="name" required>
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
                    }});
            });
        });
    </script>
@endsection