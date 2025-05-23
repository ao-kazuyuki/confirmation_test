@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('user-menu')
<a class="header__user-menu--link" href="/login">login</a>
@endsection

@section('content')
<div class="register-form">
  <div class="register-form__heading">
    <div class="register-form__heading--title">Register</div>
  </div>
  <div class="register-form__content">
    <form action="/register" method="post">
      @csrf
      <div class="register-form__group">
        <div class="register-form__label">
          <div class="register-form__input--title">お名前</div>
        </div>
        <div class="register-form__input">
          <input class="register-form__input--text" type="text" style="border: none;" name="name" value="" placeholder="例: 山田　太郎"/>
          <div class="register-form__error">
            @error('name')
              {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      <div class="register-form__group">
        <div class="register-form__label">
          <div class="register-form__input--title">メールアドレス</div>
        </div>
        <div class="register-form__input">
          <input class="register-form__input--text" type="email" style="border: none;" name="email" value="" placeholder="例: test@example.com"/>
          <div class="register-form__error">
            @error('email')
              {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      <div class="register-form__group">
        <div class="register-form__label">
          <div class="register-form__input--title">パスワード</div>
        </div>
        <div class="register-form__input">
          <input class="register-form__input--text" type="password" style="border: none;" name="password" placeholder="例: coachtech1106"/>
          <div class="register-form__error">
            @error('password')
              {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      <div class="register-form__group">
        <div class="register-form__button">
          <button class="register-form__button--submit" type="submit">登録</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
