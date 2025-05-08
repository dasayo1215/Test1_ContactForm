@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
    <div class="content">
        <div class="content__heading">
            <h2>Contact</h2>
        </div>

        <form class="form" action="/confirm" method="post">
            @csrf

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input-name" type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}" />
                        <input class="form__input--text-input-name" type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}" />
                    </div>
                </div>
            </div>
            <div class="error__wrapper">
                <div class="form__error-name">
                    @error('last_name')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form__error-name">
                    @error('first_name')
                        {{ $message }}
                    @enderror
                </div>
            </div>


            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text-radio">
                        <div class="form__input--radio">
                            <input type="radio" name="gender" value="1" id="male" checked>
                            <label for="male" class="form__label--sex">男性</label>
                        </div>
                        <div class="form__input--radio">
                            <input type="radio" name="gender" value="2" id="female" {{ old('gender') == '2' ? 'checked' : '' }}>
                            <label for="female" class="form__label--sex">女性</label>
                        </div>
                        <div class="form__input--radio">
                            <input type="radio" name="gender" value="3" id="other" {{ old('gender') == '3' ? 'checked' : '' }}>
                            <label for="other" class="form__label--sex">その他</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="error__wrapper">
                <div class="form__error">
                    @error('gender')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input" type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
                    </div>
                </div>
            </div>
            <div class="error__wrapper">
                <div class="form__error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input-tel" type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}" />
                        <div class="tel">-</div>
                        <input class="form__input--text-input-tel" type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}" />
                        <div class="tel">-</div>
                        <input class="form__input--text-input-tel" type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
                    </div>
                </div>
            </div>
            <div class="error__wrapper">
                @php
                    $telErrors = collect([
                        $errors->first('tel1'),
                        $errors->first('tel2'),
                        $errors->first('tel3'),
                    ])->filter()->unique();
                @endphp
                @if ($telErrors->isNotEmpty())
                    <div class="form__error">
                        {!! nl2br(e($telErrors->implode("\n"))) !!}
                    </div>
                @endif
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input" type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                    </div>
                </div>
            </div>
            <div class="error__wrapper">
                <div class="form__error">
                    @error('address')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input class="form__input--text-input" type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}" />
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <select class="form__input--text-input-select" name="category_id" >
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>{{ $category['content'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="error__wrapper">
                <div class="form__error">
                    @error('category_id')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form__group-area">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea class="form__input--text-input-area" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="error__wrapper">
                <div class="form__error">
                    @error('detail')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面</button>
            </div>
        </form>
    </div>
@endsection
