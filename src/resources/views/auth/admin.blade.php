<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                FashionablyLate
            </div>
            <form class="header__link-wrapper" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="header__link" type="submit">logout</button>
            </form>
        </div>
    </header>

    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Admin</h2>
            </div>

            <div class="buttons-container1">
                <form class="form" action="/admin/search" method="get">
                    @csrf
                    <input class="form__input--text" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
                    <select class="form__input--gender" name="gender">
                        <option value="">性別</option>
                        <option value="4" {{ request('gender') == '4' ? 'selected' : '' }}>全て</option>
                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                    <select class="form__input--category" name="category_id">
                        <option value="" selected>お問い合わせの種類</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>

                    <input class="form__input--date" type="date" name="date" value="{{ request('date') }}">

                    <div class="form__search">
                        <button class="form__search-button" type="submit">検索</button>
                    </div>

                    <a href="{{ route('admin') }}" class="reset">リセット</a>
                </form>
            </div>

            <div class="buttons-container2">
                <a class="export" href="{{ route('export', request()->query()) }}" >エクスポート</a>
                <div class="pagination">
                    {{ $contacts->links() }}
                </div>
            </div>

            <table class="table">
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->last_name . '　' . $contact->first_name }}</td>
                        <td>
                            {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}
                        </td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->content }}</td>
                        <td>
                            <a class="modal__open" href="{{ route('search', ['modal_detail' => $contact->id] + request()->except('modal_detail')) }}">詳細</a>
                        </td>
                    </tr>
                @endforeach

                <!-- モーダルウィンドウ -->
                @if($detailContact)
                    <div class="modal" id="modal-{{ $detailContact->id }}">
                        <div class="modal-content">
                            <a href="{{ route('search', request()->except('modal_detail')) }}" class="modal__close"></a>
                            <div class="modal__table">
                                <div class="modal__table-wrapper">
                                    <div class="modal__table-th">お名前</div>
                                    <div class="modal__table-td">{{ $detailContact->last_name . "　" . $detailContact->first_name}}</div>
                                </div>
                                <div class="modal__table-wrapper">
                                    <div class="modal__table-th">性別</div>
                                    <div class="modal__table-td">{{ $detailContact->gender == 1 ? '男性' : ($detailContact->gender == 2 ? '女性' : 'その他') }}</div>
                                </div>
                                <div class="modal__table-wrapper">
                                    <div class="modal__table-th">メールアドレス</div>
                                    <div class="modal__table-td">{{ $detailContact->email }}</div>
                                </div>
                                <div class="modal__table-wrapper">
                                    <div class="modal__table-th">電話番号</div>
                                    <div class="modal__table-td">{{ $detailContact->tel }}</div>
                                </div>
                                <div class="modal__table-wrapper">
                                    <div class="modal__table-th">住所</div>
                                    <div class="modal__table-td">{{ $detailContact->address }}</div>
                                </div>
                                <div class="modal__table-wrapper">
                                    <div class="modal__table-th">建物名</div>
                                    <div class="modal__table-td">{{ $detailContact->building }}</div>
                                </div>
                                <div class="modal__table-wrapper">
                                    <div class="modal__table-th">お問い合わせの種類</div>
                                    <div class="modal__table-td">{{ $detailContact->category->content }}</div>
                                </div>
                                <div class="modal__table-wrapper">
                                    <div class="modal__table-th">お問い合わせ内容</div>
                                    <div class="modal__table-td">{{ $detailContact->detail }}</div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('delete', ['id' => $detailContact->id] + request()->query()) }}">
                                @csrf
                                @method('DELETE')
                                <button class="modal__delete" type="submit">削除</button>
                            </form>
                        </div>
                    </div>
                @endif
            </table>
        </div>
    </main>
</body>

</html>
