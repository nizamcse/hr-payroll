@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    @include('partials.header',['title' => Auth::user()->company->name  ?? 'Winskit Hr'])
@endsection
