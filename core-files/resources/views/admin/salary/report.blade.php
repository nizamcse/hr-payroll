@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <form action="{{ route('get-salary-report') }}" method="post">
        @csrf
        <salary-report :items="{employees: {{ $employees }}}"></salary-report>
    </form>
@endsection


@section('script')
    <script src="{{ asset('core-files/public/js/app.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
@endsection
