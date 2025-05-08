<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('css/common.css') }}" /> -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                FashionablyLate
            </div>
            <a class="header__link" href="/register">
                register
            </a>
        </div>
    </header>

    <main>
        <div class="content">
            <div class="content__heading">
                <h2>Login</h2>
            </div>

            <form class="form" action="/login" method="post">
                @csrf

                <div class="form__group">
                    <span class="form__label">メールアドレス</span>
                    <input class="form__input" type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form__group">
                    <span class="form__label">パスワード</span>
                    <input class="form__input" type="password" name="password" placeholder="例: coachtech1106" />
                </div>
                <div class="form__error">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">登録</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
