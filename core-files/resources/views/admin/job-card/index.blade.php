@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <div class="card my-3">
        <div class="header">
                CREATE JOB CARD
        </div>
        <div class="body">
            <form action="{{ route('get-job-card') }}" method="post">
                @csrf
                <create-job-card :items="{{ $employees->count() ?  $employees : '' }}"></create-job-card>
                <div class="form-group text-right my-3">
                    <button class="btn btn-sm btn-info"><i class="fa fa-check-circle"></i> SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('core-files/public/js/app.js') }}"></script>
@endsection
