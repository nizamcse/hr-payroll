@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    @include('partials.header',['title' => 'List Of Companies'])
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Section List</h2>
                    <ul class="header-dropdown">
                        <li><a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#addSection">Add New</a></li>
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
                            @foreach($sections as $k => $section)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="text-right">
                                        <button data-url="{{ route('update-section',$section->id) }}" class="btn btn-outline-warning btn-sm flat btn-edit" data-toggle="modal" data-target="#editSection"><i class="fa fa-edit" ></i>Edit</button>
                                        <button data-url="{{ route('delete-section',['company_id' => Request::segment(2),'id' => $section->id]) }}" class="btn btn-outline-danger btn-sm flat btn-delete" data-toggle="modal" data-target="#delete-content-modal"><i class="fa fa-trash-o"></i> Delete</button>
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
    <div class="modal animated zoomIn" id="addSection" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('create-section') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">CREATE NEW SECTION</h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Section Name *</label>
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
    <div class="modal animated zoomIn" id="editSection" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateSection" action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">UPDATE SECTION</h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Section Name *</label>
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
                        $("#updateSection").attr('action',url);
                        $("#updateSection input[name='name']").val(result.name);
                    }});
            });
        });
    </script>
@endsection