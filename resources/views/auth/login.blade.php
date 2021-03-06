@extends('layouts.app')

@section('content')
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
            <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('login') }}">
                @csrf
                <h3 class="box-title m-b-20">Sign In</h3>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required placeholder="Username" autofocus>

                        @if ($errors->has('username'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <div class="checkbox checkbox-primary pull-left p-t-0">
                      <input type="checkbox" id="checkbox-signup" name="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label for="checkbox-signup"> Remember me </label>
                    </div>
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">
                            Login
                        </button>

                        <a class="text-dark " href="{{ route('password.request') }}">
                           <i class="fa fa-lock m-r-5"></i> Forgot Your Password?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
