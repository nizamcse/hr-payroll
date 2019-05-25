@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    @include('partials.header',['title' => 'List Of Companies'])
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Company List</h2>
                    <ul class="header-dropdown">
                        <li><a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#addcontact">Add New</a></li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                            <thead class="thead-dark">

                            <tr>
                                <th>SL</th>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Contact No</th>
                                <th>Address</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $k => $company)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>
                                        @if($company->logo)
                                            <img src="{{ asset($company->logo) }}" alt="" class="rounded-circle avatar" style="max-height: 50px">
                                        @endif
                                    </td>
                                    <td><h6 class="mb-0">{{ $company->name }}</h6></td>
                                    <td><span>{{ $company->contact_no }}</span></td>
                                    <td>{{ $company->address }}</td>
                                    <td class="text-right">
                                        @if(Auth::user()->super_admin || Auth::user()->can('edit-company',$company->id))
                                            <a href="{{ route('edit-company',['id' => $company->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i> Edit</a>
                                            <button class="btn btn-sm btn-outline-warning btn-update-admin" data-url="{{ route('update-company-user-pass',['id' => $company->id]) }}" data-toggle="modal" data-target="#adminUpdate"><i class="fa fa-cogs"></i> Admin</button>
                                            <button class="btn btn-sm btn-outline-danger btn-delete" data-url="{{ route('delete-company',['id' => $company->id]) }}" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o"></i> Delete</button>
                                        @endif
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
    <div class="modal animated zoomIn" id="addcontact" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('store-company') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">CREATE NEW COMPANY</h6>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company Name *</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact No</label>
                                        <input type="text" class="form-control" name="contact_no" value="{{ old('contact_no') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="company_email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upload Logo</label>
                                        <input type="file" name="logo">
                                    </div>
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
    <div class="modal animated zoomIn" id="adminUpdate" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="updateAdmin" action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">UPDATE ADMIN</h6>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Admin Name *</label>
                                        <input type="text" class="form-control" name="admin_name" v-model="user.name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" v-model="user.email" @keyup="findUser" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="!user.id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" v-model="user.password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" v-model="user.confirmPassword" required>
                                    </div>
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
            $(document).on('click','.btn-update-admin',function(){
                var url = $(this).data('url');
                $.ajax({url: url, success: function(result){
                        $("#updateAdmin").attr('action',url);
                        $("#updateAdmin input[name='email']").val(result.email);
                        $("#updateAdmin input[name='admin_name']").val(result.name);
                    }});
            });
        });
    </script>
@endsection