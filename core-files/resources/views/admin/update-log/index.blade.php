@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card my-3">
                <div class="header">
                    <h2>Update Logs</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                            <thead class="thead-dark">

                            <tr>
                                <th>SL</th>
                                <th>Device Name</th>
                                <th>Device Ip</th>
                                <th>Device Number</th>
                                <th>Data Type</th>
                                <th>Total Data</th>
                                <th>Remaining Data</th>
                                <th>Log Updated</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $k => $log)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $log->device->name ?? '' }}</td>
                                    <td>{{ $log->device->ip_address ?? '' }}</td>
                                    <td>{{ $log->device->device_no ?? '' }}</td>
                                    <td>{{ $log->data_type ?? '' }}</td>
                                    <td>{{ $log->total_data ?? '' }}</td>
                                    <td>{{ $log->remaining_data ?? '' }}</td>
                                    <td>{{ $log->device->created_at ?? '' }}</td>
                                    <td class="text-right">
                                        @if($log->remaining_data > 0)
                                            @if($log->data_type == 'logs')
                                                <a href="{{ route('insert-attendance',['id' => $log->id]) }}" class="btn btn-outline-success btn-sm"><i class="fa fa-database"></i> Import Data</a>
                                            @else
                                                <a href="{{ route('insert-employee',['id' => $log->id]) }}" class="btn btn-outline-success btn-sm"><i class="fa fa-database"></i> Import Data</a>
                                            @endif
                                        @endif
                                        <button data-url="{{ route('delete-log',['id' => $log->id]) }}" class="btn btn-outline-danger btn-sm flat btn-delete" data-toggle="modal" data-target="#delete-content-modal"><i class="fa fa-trash-o"></i> Delete</button>
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
@endsection
