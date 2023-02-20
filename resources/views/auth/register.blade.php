@extends('layouts.app')

@section('content')

<div class="container">

    <form class="auth-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="auth-form__input form-input">
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <div class="auth-form__input form-input">
            <label for="email">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <div class="auth-form__input form-input">
            <label for="password" >{{ __('Password') }}</label>
            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <div class="auth-form__input form-input">
            <label for="password-confirm" >{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="@error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

            @error('password')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </form>
</div>
@endsection
