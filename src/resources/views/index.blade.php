@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__heading">
  <div class="contact-form__heading--title">Contact</div>
</div>

<form action="/confirm" method="post">
  @csrf
  <table>
    <tr class="contact-form__group">
      <th rowspan="2" class="contact-form__label">
        <span class="contact-form__label--required">お名前</span>
      </th>
      <td colspan="2" class="contact-form__input">
        <input class="contact-form__input--name" type="text" name="first_name" value="{{ old('first_name', $forms['first_name'] ?? '' ) }}" placeholder="例: 山田">
      </td>
      <td colspan="3" class="contact-form__input">
        <input class="contact-form__input--name" type="text" name="last_name" value="{{ old('last_name', $forms['last_name'] ?? '' ) }}" placeholder="例: 太郎">
      </td>
    </tr>
    <tr class="contact-form__group">
      <td colspan="2" class="contact-form__error">
        <span class="contact-form__error--text">
          @error('first_name')
            {{ $errors->first('first_name') }}
          @enderror
        </span>
      </td>
      <td colspan="3" class="contact-form__error">
        <span class="contact-form__error--text">
          @error('last_name')
            {{ $errors->first('last_name') }}
          @enderror
        </span>
      </td>
    </tr>
    <tr class="contact-form__group">
      <th rowspan="2" class="contact-form__label">
        <span class="contact-form__label--required">性別</span>
      </th>
      <td colspan="5" class="contact-form__input">
        <label for="man"><input class="contact-form__input--radio" type="radio" id="man" name="gender" value="1" {{ old('gender', $forms['gender'] ?? '') == "1" ? 'checked' : '' }} checked><span class="contact-form__input--custom-radio"></span>男性</label>
        <label for="woman"><input class="contact-form__input--radio" type="radio" id="woman" name="gender" value="2" {{ old('gender', $forms['gender'] ?? '') == "2" ? 'checked' : '' }}><span class="contact-form__input--custom-radio"></span>女性</label>
        <label for="other"><input class="contact-form__input--radio" type="radio" id="other" name="gender" value="3" {{ old('gender', $forms['gender'] ?? '') == "3" ? 'checked' : '' }}><span class="contact-form__input--custom-radio"></span>その他</label>
      </td>
    </tr>
    <tr class="contact-form__group">
      <td colspan="5" class="contact-form__error">
        <span class="contact-form__error--text">
          @error('gender')
            {{ $errors->first('gender') }}
          @enderror
        </span>
      </td>
    </tr>
    <tr class="contact-form__group">
      <th rowspan="2" class="contact-form__label">
        <span class="contact-form__label--required">メールアドレス</span>
      </th>
      <td colspan="5" class="contact-form__input">
        <input class="contact-form__input--email" type="email" name="email" value="{{ old('email', $forms['email'] ?? '' ) }}" placeholder="例: test@example.com">
      </td>
    </tr>
    <tr class="contact-form__group">
      <td colspan="5" class="contact-form__error">
        <span class="contact-form__error--text">
          @error('email')
            {{ $errors->first('email') }}
          @enderror
        </span>
      </td>
    </tr>
    <tr class="contact-form__group">
      <th rowspan="2" class="contact-form__label">
        <span class="contact-form__label--required">電話番号</span>
      </th>
      <td class="contact-form__input">
        <input class="contact-form__input--tel" type="text" name="tel_first"  value="{{ old('tel_first', $forms['tel_first'] ?? '' ) }}"  placeholder="080">        
      </td>
      <td class="contact-form__input">
        <span class="contact-form__input--hyphen">-</span>
      </td>
      <td class="contact-form__input">
        <input class="contact-form__input--tel" type="text" name="tel_second" value="{{ old('tel_second', $forms['tel_second'] ?? '' ) }}" placeholder="1234">
      </td>
      <td class="contact-form__input">
        <span class="contact-form__input--hyphen">-</span>
      </td>
      <td class="contact-form__input">
        <input class="contact-form__input--tel" type="text" name="tel_third"  value="{{ old('tel_third', $forms['tel_third'] ?? '' ) }}"  placeholder="5678">        
      </td>
    </tr>
    <tr class="contact-form__group">
      <td colspan="5" class="contact-form__error">
        <span class="contact-form__error--text">
          @if( $errors->has('tel_first') )
            {{ $errors->first('tel_first') }}
          @elseif( $errors->has('tel_second') )
            {{ $errors->first('tel_second') }}
          @elseif( $errors->has('tel_third') )
            {{ $errors->first('tel_third') }}
          @endif
        </span>
      </td>
    </tr>
    <tr class="contact-form__group">
      <th rowspan="2" class="contact-form__label">
        <span class="contact-form__label--required">住所</span>
      </th>
      <td colspan="5" class="contact-form__input">
        <input class="contact-form__input--address" type="text" name="address" value="{{ old('address', $forms['address'] ?? '' ) }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
      </td>
    </tr>
    <tr class="contact-form__group">
      <td colspan="5" class="contact-form__error">
        <span class="contact-form__error--text">
          @error('address')
            {{ $errors->first('address') }}
          @enderror
        </span>
      </td>
    </tr>
    <tr class="contact-form__group">
      <th rowspan="2" class="contact-form__label">
        <span class="contact-form__label">建物名</span>
      </th>
      <td colspan="5" class="contact-form__input">
        <input class="contact-form__input--building" type="text" name="building" value="{{ old('building', $forms['building'] ?? '' ) }}" placeholder="例: 千駄ヶ谷マンション101">
      </td>
    </tr>
    <tr class="contact-form__group">
      <td colspan="5" class="contact-form__error">
        <span class="contact-form__error--text">
          @error('building')
            {{ $errors->first('building') }}
          @enderror
        </span>
      </td>
    </tr>
    <tr class="contact-form__group">
      <th rowspan="2" class="contact-form__label">
        <span class="contact-form__label--required">お問い合わせの種類</span>
      </th>
      <td colspan="5" class="contact-form__input">
        <select class="contact-form__input--category" name="category_id">
          <option value="" selected>選択してください</option>
          @foreach( $categorys as $category )
          <option value="{{ $category->id }}" {{ old('category_id', $forms['category_id'] ?? '' ) == $loop->iteration ? 'selected' : '' }}>{{ $category->content }}</option>
          @endforeach
        </select>
      </td>
    </tr>
    <tr class="contact-form__group">
      <td colspan="5" class="contact-form__error">
        <span class="contact-form__error--text">
          @error('category_id')
            {{ $errors->first('category_id') }}
          @enderror
        </span>
      </td>
    </tr>
    <tr class="contact-form__group">
      <th rowspan="2" class="contact-form__label">
        <span class="contact-form__label--required">お問い合わせ内容</span>
      </th>
      <td colspan="5" class="contact-form__input">
        <textarea class="contact-form__input--detail" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $forms['detail'] ?? '' ) }}</textarea>
      </td>
    </tr>
    <tr class="contact-form__group">
      <td colspan="5" class="contact-form__error">
        <span class="contact-form__error--text">
          @error('detail')
            {{ $errors->first('detail') }}
          @enderror
        </span>
      </td>
    </tr>
    <tr class="contact-form__group">
      <th class="contact-form__button" colspan="6">
        <button class="contact-form__button--submit" type="submit">確認画面</button>
      </th>
    </tr>
  </table>
</form>
@endsection