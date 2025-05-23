@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('user-menu')
<a class="header__user-menu--link" href="/register">register</a>
@endsection

@section('content')
<div class="login-form">
  <div class="login-form__heading">
    <div class="login-form__heading--title">Login</div>
  </div>
  <div class="login-form__content">
    <form action="/login" method="post">
      @csrf
      <div class="login-form__group">
        <div class="login-form__label">
          <div class="login-form__input--title">メールアドレス</div>
        </div>
        <div class="login-form__input">
          <input class="login-form__input--text" type="email" style="border: none;" name="email" value="" placeholder="例: test@example.com"/>
          <div class="login-form__error">
            @error('email')
              {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      <div class="login-form__group">
        <div class="login-form__label">
          <div class="login-form__input--title">パスワード</div>
        </div>
        <div class="login-form__input">
          <input class="login-form__input--text" type="password" style="border: none;" name="password" placeholder="例: coachtech1106"/>
          <div class="login-form__error">
            @error('password')
              {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      <div class="login-form__group">
        <div class="login-form__button">
          <button class="login-form__button--submit" type="submit">ログイン</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection