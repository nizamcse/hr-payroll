@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <div class="card my-3">
        <div class="header text-center">
            Job Card
        </div>
        <div class="body">
            <table class="table table-borderless">

                <tbody>
                <tr>
                    <td>ID.</td>
                    <td>:</td>
                    <td>{{ $employee->id }}</td>

                    <td></td>
                    <td></td>
                    <td></td>

                    <td>Branch</td>
                    <td>:</td>
                    <td>{{ $employee->branch->name }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td>{{ $employee->name }}</td>

                    <td></td>
                    <td></td>
                    <td></td>

                    <td>Section</td>
                    <td>:</td>
                    <td>{{ $employee->section->name }}</td>
                </tr>
                <tr>
                    <td>Date of Join</td>
                    <td>:</td>
                    <td>{{ $employee->joining_date }}</td>

                    <td>Line</td>
                    <td>:</td>
                    <td>{{ $employee->line->name }}</td>

                    <td>Designation</td>
                    <td>:</td>
                    <td>{{ $employee->designation->name }}</td>
                </tr>
                </tbody>
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th scope="col">SI#</th>
                        <th scope="col">Date</th>
                        <th scope="col">In-Time</th>
                        <th scope="col">Out-Time</th>
                        <th scope="col">Total HR</th>
                        <th scope="col">OT</th>
                        <th scope="col">In Status</th>
                        <th scope="col">Out Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($days as $day)
                        <tr>
                            <td scope="row"></td>
                            <td>{{ $day['main_date'] }}</td>
                            <td>{{ $day['attendance']->in_time ?? null }}</td>
                            <td>{{ $day['attendance']->exit_time ?? null }}</td>
                            <td>{{ $day['attendance']->measurement_quantity ?? null }}</td>
                            <td>{{ $day['attendance']->overtime ?? null }}</td>
                            <td>{{ $day['attendance']->in_status ?? null }}</td>
                            <td>{{ $day['attendance']->out_status ?? null }}</td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </table>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('core-files/public/js/app.js') }}"></script>
@endsection