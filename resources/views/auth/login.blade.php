@extends('layouts.app-auth')

@section('content')

<section class="hero">
    <div class="hero-body">
        <h1 class="title">
            {{ __('Login') }}
        </h1>
    </div>
</section>
<div class='box'>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <p class="control">
                <input id="email" type="email" placeholder="Email" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
            </p>
            @if ($errors->has('email'))
            <p class="help is-danger">
                {{ $errors->first('email') }}
            </p>
            @endif
        </div>
        <div class="field">
            <p class="control">
                <input id="password" type="password" placeholder="Password" class="input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            </p>
            @if ($errors->has('password'))
            <p class="help is-danger">
                {{ $errors->first('password') }}
            </p>
            @endif
        </div>
        <button type="submit" class="button is-block is-info is-large is-fullwidth"> {{ __('Login') }}</button>
    </form>
</div>




<div class="container" style="display:none;">
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
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
