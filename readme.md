README
# アプリケーション名
    お問い合わせフォーム

## 環境構築
    - Dockerビルド
        1. git clone リンク：git@github.com:coachtech-material/laravel-docker-template.git
        2. docker-compose up -d --build
    ＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

    - Laravel環境構築
        1. docker-compose exec php bash
        2. composer install
        3. .env.exampleファイルから.envを作成し、環境変数を変更
        4. php artisan key:generate
        5. php artisan migrate
        6. php artisan db:seed

## 使用技術(実行環境)
    - OS：Windows 11
    - フレームワーク：Laravel 8.x
    - プログラミング言語：PHP 8.x
    - コンテナ管理：Docker
    - データベース： MySQL 8.0.x
    - バージョン管理：Git / GitHub

## ER図

 < - - - 作成したER図の画像 - - - >

## URL
    - 開発環境：http://localhost/
    - phpMyAdmin：http://localhost:8080/

## その他
    - contactsテーブルで、category_idはnotnull指定のため、category_idが削除されたときに該当category_idを含むレコードが自動で削除されるようにcascadeDeleteを付けた（マイグレーションファイル2025_05_02_123732_create_contacts_table.php）。
    - お問い合わせフォームの入力画面において、性別はデフォルトで男性を選択することにしているため、「性別を選択してください」というエラーは出現しない。
    - お問い合わせフォームの入力画面において、電話番号の入力欄は画像イメージ通り３つ設けた。３つの欄のうち１つでも空欄があれば「電話番号を入力してください」、1つでも半角数字ではないもしくはハイフンなしの欄があれば「電話番号は5桁までの数字で入力してください」というエラーを表示する仕様とした。
    -   登録ページでは、登録が完了したらログインページに遷移するようにした。
    -   登録ページ・ログインページにおいては、バリデーションにフォームリクエストを使用する指定である。Fortifyのバリデーションは利用せず、Fortifyが提供するサービスプロバイダやインターフェースを活用ながら自身で作ったフォームリクエスト（UserRequest.php, LoginRequest.php）を利用するため、AuthController.phpを作成した。

