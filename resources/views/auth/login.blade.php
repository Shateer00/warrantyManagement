@extends('layouts.welcome')
@section('title')
Login
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card cardShadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <a href="{{ url('/') }}"><i class=" fas fa-angle-left"></i></a>
                        </div>
                        <div class="col">
                            <div class="text-center font-weight-bolder">{{ __('welcome.login') }}</div>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row ">
                            <label for="email" class="col-sm-4 col-form-label text-md-right font-weight-bold">{{
                                __('Alamat Email')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" placeholder="Alamat Email" required autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{
                                __('Kata Sandi')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" placeholder="Kata Sandi" required>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm offset-md-4">
                                {{--
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('welcome.login') }}
                                </button>
                                <a class="btn btn-secondary" href="{{ route('password.request') }}">
                                    {{ __('Lupa Kata Sandi ?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
