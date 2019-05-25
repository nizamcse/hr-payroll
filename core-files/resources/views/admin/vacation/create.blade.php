@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card my-3">
                <div class="header">
                    <h5>
                        CREATE VACATION
                        <a href="{{ route('vacations') }}" class="btn btn-info btn-sm pull-right"> <i class="fa fa-list"></i> Vacations</a>
                    </h5>
                </div>
                <div class="body">
                    <form action="{{ route('store-vacation',['company_id' => Request::segment(2)]) }}" method="post">
                        @csrf
                        <vacation-form></vacation-form>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script src="{{ asset('core-files/public/js/app.js') }}"></script>
@endsection
