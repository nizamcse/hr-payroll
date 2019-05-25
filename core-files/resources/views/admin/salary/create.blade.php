@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <div class="card my-3">
        <div class="header">
            <h3>
                CREATE SALARY
                <a href="{{ route('employee-salaries') }}" class="btn btn-info btn-sm pull-right flat"> <i class="fa fa-list"></i> Salaries</a>
            </h3>
        </div>
    </div>
    <form action="{{ route('store-salary') }}" method="post">
        @csrf
        <create-salary :items="{employees: {{ $employees }},apiUrl:'{{ route('get-salary-details') }}',deductions: {{ $deductions }},bonuses: {{ $bonuses }} }"></create-salary>
    </form>
@endsection


@section('script')
    <script src="{{ asset('core-files/public/js/app.js') }}"></script>
@endsection
