@extends('layouts.app-auth')

@section('content')

<section class="hero">
    <div class="hero-body">
        <h1 class="title">
            {{ __('Register') }}
        </h1>
    </div>
</section>

<div class='box'>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="field">
            <label class="label">{{ __('Name') }}</label>
            <p class="control">
                <input id="name" type="text" class="input {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            </p>
            @if ($errors->has('name'))
            <p class="help is-danger">
                {{ $errors->first('name') }}
            </p>
            @endif
        </div>
        <div class="field">
            <label class="label">{{ __('E-Mail Address') }}</label>
            <p class="control">
                <input id="email" type="email" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            </p>
            @if ($errors->has('email'))
            <p class="help is-danger">
                {{ $errors->first('email') }}
            </p>
            @endif
        </div>
        <div class="field">
            <label class="label">{{ __('Password') }}</label>
            <p class="control">
                <input id="password" type="password" class="input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            </p>
            @if ($errors->has('password'))
            <p class="help is-danger">
                {{ $errors->first('password') }}
            </p>
            @endif
        </div>
        <div class="field">
            <label class="label">{{ __('Confirm Password') }}</label>
            <p class="control">
                <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
            </p>
            @if ($errors->has('password-confirm'))
            <p class="help is-danger">
                {{ $errors->first('password-confirm') }}
            </p>
            @endif
        </div>
        <button type="submit" class="button is-block is-info is-large is-fullwidth"> {{ __('Register') }}</button>
    </form>
</div>

<div class="container" style="display:none;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
