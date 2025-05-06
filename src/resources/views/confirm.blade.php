@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection


@section('content')
    <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2>Confirm</h2>
        </div>
        <form class="form" action="/" method="post">
            @csrf

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input" type="text" value="{{ $contact['name'] }}" readonly />
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
                    </div>
                    <div class="form__error">
                        <!-- ここも苗字と名前 -->
                    @error('name')
                    {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input" type="text" value="{{
                            $contact['gender'] == 1 ? '男性' :
                            ($contact['gender'] == 2 ? '女性' : 'その他')
                        }}" readonly />
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                    </div>
                    <div class="form__error">
                    @error('gender')
                    {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input" type="email" name="email" value="{{ $contact['email'] }}" readonly />
                    </div>
                    <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input" type="tel" name="tel" value="{{ $contact['tel'] }}" readonly />
                    </div>
                    <div class="form__error">
                    @error('tel')
                    {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input" type="text" name="address" value="{{ $contact['address'] }}" readonly />
                    </div>
                    <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input" type="text" name="building" value="{{ $contact['building'] }}" readonly />
                    </div>
                    <div class="form__error">
                    @error('building')
                    {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input" type="text" value="{{ $contact['category_content'] }}" readonly>
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    </div>
                    <div class="form__error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form__group-area">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea class="form__input--text-input" name="detail" readonly>{{ $contact['detail'] }}</textarea>
                    </div>
                </div>
            </div>
            <div class="form__buttons">
                <button class="form__button-submit" type="submit">送信</button>
            </div>
        </form>
        <form class="form__buttons" action="/fix" method="post">
            @csrf
            <button class="form__button-fix" type="submit">修正</button>
        </form>
    </div>
@endsection
