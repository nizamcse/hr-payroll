@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')

    <div class="card my-3">
        <div class="header">
            <h5>
                LIST OF VACATION FOR {{ $year }}
                <a href="{{ route('create-vacation') }}"
                   class="btn btn-sm pull-right btn-info">
                    <i class="fa fa-plus-circle"></i> CREATE NEW
                </a>
            </h5>
        </div>
        <div class="body">
            <table id="vacationss-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Allowed Days</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($vacations as $k => $vacation)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $vacation->name }}</td>
                        <td>{{ $vacation->from_date }}</td>
                        <td>{{ $vacation->to_date }}</td>
                        <td>{{ $vacation->allowed_days }}</td>
                        <td class="text-right">
                            <a href="{{ route('edit-vacation',['id' => $vacation->id]) }}"
                                    class="btn btn-warning btn-xs flat btn-delete"><i class="fa fa-edit"></i> Edit
                            </a>
                            <button data-url="{{ route('delete-vacation',['id' => $vacation->id]) }}"
                                    class="btn btn-danger btn-xs flat btn-delete" data-toggle="modal"
                                    data-target="#delete-content-modal"><i class="fa fa-trash-o"></i>Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            //$('#vacationss-table').DataTable()
        });
    </script>
@endsection
