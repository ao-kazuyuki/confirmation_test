@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')

<div class="contact-form__heading">
  <div class="contact-form__heading--title">Confirm</div>
</div>

<form action="/thanks" method="post">
  @csrf
  <table>
    <tr class="contact-form__group">
      <th class="contact-form__label">
        <span class="contact-form__label">お名前</span>
      </th>
      <td class="contact-form__input">
        <span class="contact-form__input">{{ $form[ 'first_name' ] }}　{{ $form[ 'last_name' ] }}</span>
        <input type="hidden" name="first_name" value="{{ $form[ 'first_name' ] }}" />
        <input type="hidden" name="last_name" value="{{ $form[ 'last_name' ] }}"  />
      </td>
    </tr>
    <tr class="contact-form__group">
      <th class="contact-form__label">
        <span class="contact-form__label">性別</span>
      </th>
      <td class="contact-form__input">
        @switch( $form[ 'gender' ] )
            @case (1)
                <span class="contact-form__input">男性</span>
                @break
            @case (2)
                <span class="contact-form__input">女性</span>
                @break
            @case (3)
                <span class="contact-form__input">その他</span>
                @break
        @endswitch
        <input type="hidden" name="gender" value="{{ $form[ 'gender' ] }}" />
      </td>
    </tr>
    <tr class="contact-form__group">
      <th class="contact-form__label">
        <span class="contact-form__label">メールアドレス</span>
      </th>
      <td class="contact-form__input">
        <span class="contact-form__input">{{ $form[ 'email' ] }}</span>
        <input type="hidden" name="email" value="{{ $form[ 'email' ] }}" />
      </td>
    </tr>
    <tr class="contact-form__group">
      <th class="contact-form__label">
        <span class="contact-form__label">電話番号</span>
      </th>
      <td class="contact-form__input">
        @php
          $tel = $form[ 'tel_first' ]. $form[ 'tel_second' ]. $form[ 'tel_third' ];
        @endphp
        <span class="contact-form__input">{{ $tel }}</span>
        <input type="hidden" name="tel_first" value="{{ $form[ 'tel_first' ] }}" />
        <input type="hidden" name="tel_second" value="{{ $form[ 'tel_second' ] }}" />
        <input type="hidden" name="tel_third" value="{{ $form[ 'tel_third' ] }}" />
        <input type="hidden" name="tel" value="{{ $tel }}" />
      </td>
    </tr>
    <tr class="contact-form__group">
      <th class="contact-form__label">
        <span class="contact-form__label">住所</span>
      </th>
      <td class="contact-form__input">
        <span class="contact-form__input">{{ $form[ 'address' ] }}</span>
        <input type="hidden" name="address" value="{{ $form[ 'address' ] }}" />
      </td>
    </tr>
    <tr class="contact-form__group">
      <th class="contact-form__label">
        <span class="contact-form__label">建物名</span>
      </th>
      <td class="contact-form__input">
        <span class="contact-form__input">{{ $form[ 'building' ] }}</span>
        <input type="hidden" name="building" value="{{ $form[ 'building' ] }}" />
      </td>
    </tr>
    <tr class="contact-form__group">
      <th class="contact-form__label">
        <span class="contact-form__label">お問い合わせの種類</span>
      </th>
      <td class="contact-form__input">
        @php
          $contact_type = $categorys[ $form[ 'category_id' ] - 1 ]->content;
        @endphp
        <span class="contact-form__input">{{ $contact_type }}</span>
        <input type="hidden" name="category_id" value="{{ $form[ 'category_id' ] }}" />
      </td>
    </tr>
    <tr class="contact-form__group">
      <th class="contact-form__label">
        <span class="contact-form__label">お問い合わせ内容</span>
      </th>
      <td class="contact-form__input">
        <span class="contact-form__input">{{ $form[ 'detail' ] }}</span>
        <input type="hidden" name="detail" value="{{ $form[ 'detail' ] }}" />
      </td>
    </tr>
    <tr class="contact-form__group">
      <th colspan="2" style="background-color:#ffffff;border-color:#ffffff" class="contact-form__button">
        <button class="contact-form__button--submit" type="submit">送信</button>
        <button class="contact-form__button--retry"  type="submit" formaction="/" formmethod="post">修正</button>
      </th>
    </tr>
  </table>
</form>
@endsection