@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

                    <div class="flex items-center justify-end mt-4">
                        <a class="btn mb-2" href="{{ url('login/twitter') }}"
                            style="background: #1E9DEA; padding: 10px; width: 100%; text-align: center; display: block; border-radius:4px; color: #ffffff;">
                            <i class="fab fa-twitter mr-3"></i>
                            Login with Twitter
                        </a>

                        <a class="btn mb-2" href="{{ url('login/facebook') }}"
                            style="background: #92beda; padding: 10px; width: 100%; text-align: center; display: block; border-radius:4px; color: #ffffff;">
                            <i class="fab fa-facebook mr-3"></i>
                            Login with Facebook
                        </a>

                        <a class="btn mb-2" href="{{ url('login/github') }}"
                            style="background: #131516; padding: 10px; width: 100%; text-align: center; display: block; border-radius:4px; color: #ffffff;">
                            <i class="fab fa-github mr-3"></i>
                            Login with Github
                        </a>

                        <a class="btn mb-2" href="{{ url('login/gmail') }}"
                            style="background: #ffde96; padding: 10px; width: 100%; text-align: center; display: block; border-radius:4px; color: #ffffff;">
                            <i class="fab fa-google mr-3"></i>
                            Login with Google
                        </a>

                        <a class="btn mb-2" href="{{ url('login/reddit') }}"
                            style="background: #f75b13; padding: 10px; width: 100%; text-align: center; display: block; border-radius:4px; color: #ffffff;">
                            <i class="fab fa-reddit mr-3"></i>
                            Login with Reddit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
