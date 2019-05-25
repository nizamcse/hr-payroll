@extends('layouts.company')

@section('content')
    @include('partials.header',['title' => 'Calculate Attendance'])
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="alert {{ $status ? 'alert-success' : 'alert-danger' }}">
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
@endsection