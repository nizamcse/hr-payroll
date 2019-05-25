@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <attendance-report :items="{employees: {{ $employees }},apiUrl:'{{ route('get-attendance-report') }}' }"></attendance-report>
@endsection


@section('script')
    <script src="{{ asset('core-files/public/js/app.js') }}"></script>
@endsection
