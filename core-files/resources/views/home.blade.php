@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-3">
                <div class="header">Dashboard</div>

                <div class="body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
@endsection
