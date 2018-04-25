@extends('layouts.app')

@section('content')
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal"  method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group ">
                  <div class="col-xs-12">
                    <h3>Recover Password</h3>
                    <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                  </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light">
                            Send Password Reset Link
                        </button>
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button type="button" onclick="javascript:void(0); location.href='{{ route('login') }}'" class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light">
                            Go Back
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
