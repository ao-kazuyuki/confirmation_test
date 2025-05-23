@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

<script>
  let openModal = function( contact_id, first_name, last_name, gender, email, tel, address, building, category_content, detail ){
    document.getElementById('contact_id').value = contact_id;
    document.getElementById('first_name').textContent = first_name;
    document.getElementById('last_name').textContent = last_name;
    let output_gender = "";
    switch(gender){
      case "1":
        output_gender = "男性";
        break;
      case "2":
        output_gender = "女性";
        break;
      case "3":
        output_gender = "その他";
        break;
    }
    document.getElementById('gender').textContent = output_gender;
    document.getElementById('email').textContent = email;
    document.getElementById('tel').textContent = tel;
    document.getElementById('address').textContent = address;
    document.getElementById('building').textContent = building;
    document.getElementById('category_content').textContent = category_content;
    document.getElementById('detail').textContent = detail;
    document.getElementById('modal').style.display = 'flex';
  }
  let closeModal = function() {
    document.getElementById('modal').style.display = 'none';
  }

  let requestExport = function(){
    fetch('/admin/export', {
      method: 'post',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({
        "keyword": document.getElementById("ex_keyword").value,
        "gender": document.getElementById("ex_gender").value,
        "kategory_id": document.getElementById("ex_category_id").value,
        "created_at": document.getElementById("ex_created_at").value
      })
    })
    .then(response => response.text())

    .then(csvText => {
      const blob = new Blob([csvText], { type: 'text/csv;charset=Shift_JIS' });
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = "export_data.csv";
      a.click();
      window.URL.revokeObjectURL(url);
    })

    .then(result => {
      console.log( '出力が完了しました。:', result );
    })
    .catch(error => {
      console.error( '出力に失敗しました。:', error );
    })
  }

</script>

@section('user-menu')
<form action="/logout" method="post">
  @csrf
  <button class="header__user-menu--button" href="/logout">logout</button>
</form>
@endsection

@section('content')

<div class="admin__heading">
  <div class="admin__heading--title">Admin</div>
</div>

<form class="search-menu" action="/admin/search" method="get">
  @csrf
  <input id="ex_keyword" class="search-menu__keyword" type="text" name="keyword" value="{{ $forms['keyword'] ?? '' }}" placeholder="名前やメールアドレスを入力して下さい">
  <select id="ex_gender" name="gender">
    <option value="" checked>性別</option>
    <option value="0" {{ ( $forms['gender'] ?? '' ) == '0' ? 'selected' : '' }} >全て</option>
    <option value="1" {{ ( $forms['gender'] ?? '' ) == '1' ? 'selected' : '' }} >男性</option>
    <option value="2" {{ ( $forms['gender'] ?? '' ) == '2' ? 'selected' : '' }} >女性</option>
    <option value="3" {{ ( $forms['gender'] ?? '' ) == '3' ? 'selected' : '' }} >その他</option>
  </select>
  <select id="ex_category_id" name="category_id">
    <option value="" selected>お問い合わせの種類</option>
    @foreach( $categorys as $category )
    <option value="{{ $loop->iteration }}" {{ ( $forms['category_id'] ?? '' ) == $loop->iteration ? 'selected' : '' }} >{{ $category->content }}</option>
    @endforeach
  </select>
  <input type="date" id="ex_created_at" name="created_at" value="{{ $forms['created_at'] ?? '' }}" />
  <button class="search-button" type="submit">検索</button>
  <button class="reset-button" type="submit" formaction="/admin/reset" formmethod="">リセット</button>
</form>

<div class="sub-menu">
  <div class="sub-menu__export">
    <button class="sub-menu__export--button" onclick="requestExport()">エクスポート</button>
  </div>
  <div class="sub-menu__links">
    {{ $contacts->links() }}
  </div>
</div>

<table class="contact-list">
  <tr>
    <th class="contact-list__header">お名前</th>
    <th class="contact-list__header">性別</th>
    <th class="contact-list__header">メールアドレス</th>
    <th class="contact-list__header" colspan="2">お問い合わせの種類</th>
  </tr>
@foreach( $contacts as $contact )
  <tr>
    <td class="cpmtact-list__value">{{$contact->first_name}}　{{$contact->last_name}}</td>
    @switch( $contact->gender )
      @case (1)
        <td class="cpmtact-list__value">男性</td>
        @break
      @case (2)
        <td class="cpmtact-list__value">女性</td>
        @break
      @case (3)
        <td class="cpmtact-list__value">その他</td>
        @break
    @endswitch
    <td class="cpmtact-list__value">{{$contact->email}}</td>
    <td class="cpmtact-list__value">{{$contact->category->content}}</td>
    <td class="cpmtact-list__value"><button class="detail-button" onclick="openModal('{{ $contact->id }}',
                                                                                     '{{ $contact->first_name }}',
                                                                                     '{{ $contact->last_name }}',
                                                                                     '{{ $contact->gender }}',
                                                                                     '{{ $contact->email }}',
                                                                                     '{{ $contact->tel }}',
                                                                                     '{{ $contact->address }}',
                                                                                     '{{ $contact->building }}',
                                                                                     '{{ $contact->category->content }}',
                                                                                     '{{ $contact->detail }}')">詳細</button></td>
  </tr>
@endforeach
</table>

<div id="modal" class="modal-overlay">
    <div class="modal-content">
        <button class="modal-content__close-btn" onclick="closeModal()">×</button>
        <table class="modal-content__table">
          <tr>
            <th class="modal-content__header">お名前</th>
            <td class="modal-content__value"><span id="first_name"></span>　<span id="last_name"></span></td>
          </tr>
          <tr>
            <th class="modal-content__header">性別</th>
            <td class="modal-content__value"><span id="gender"></span></td>
          </tr>
          <tr>
            <th class="modal-content__header">メールアドレス</th>
            <td class="modal-content__value"><span id="email"></span></td>
          </tr>
          <tr>
            <th class="modal-content__header">電話番号</th>
            <td class="modal-content__value"><span id="tel"></span></td>
          </tr>
          <tr>
            <th class="modal-content__header">住所</th>
            <td class="modal-content__value"><span id="address"></span></td>
          </tr>
          <tr>
            <th class="modal-content__header">建物名</th>
            <td class="modal-content__value"><span id="building"></span></td>
          </tr>
          <tr>
            <th class="modal-content__header">お問い合わせの種類</th>
            <td class="modal-content__value"><span id="category_content"></span></td>
          </tr>
          <tr>
            <th class="modal-content__header">お問い合わせ内容</th>
            <td class="modal-content__value"><span id="detail"></span></td>
          </tr>
        </table>
        <form action="/admin/delete" method="post">
            @method('DELETE')
            @csrf
            <div class="modal-content__button">
                <input type="hidden" id="contact_id" name="contact_id">
                <button class="modal-content__button--style" type="submit">削除</button>
            </div>
        </form>
    </div>
</div>
@endsection