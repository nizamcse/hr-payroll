@extends('layouts.auth')
@section('content')
    <div class="auth-box">
        <div class="top text-center">
            <img src="{{ asset('public/admin/assets/images/winskit-logo-272.png') }}" class="ml-auto mr-auto" alt="Winskit Hr">
        </div>
        <div class="card">
            <div class="header">
                <p class="lead">Login to your account</p>
            </div>
            <div class="body">
                <form class="form-auth-small" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only">Email</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="signin-email" name="email" value="{{ old('email') }}" required placeholder="Email Or Username">
                        @if($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Password</label>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                    <div class="bottom">
                        @if (Route::has('password.request'))
                            <span class="helper-text m-b-10">
                                <i class="fa fa-lock"></i> <a href="{{ route('password.request') }}">Forgot password?</a>
                            </span>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection