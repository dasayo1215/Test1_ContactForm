README
# アプリケーション名
    お問い合わせフォーム

## 環境構築
    - Dockerビルド
        1. git clone リンク：git@github.com:dasayo1215/Test1_ContactForm.git
        2. docker-compose up -d --build
    ＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

    - Laravel環境構築
        1. docker-compose exec php bash
        2. composer install
        3. .env.exampleファイルから.envを作成し、環境変数を変更
            変更前：DB_HOST=127.0.0.1　    変更後：DB_HOST=mysql
            変更前：DB_DATABASE=laravel    変更後：DB_DATABASE=laravel_db
            変更前：DB_USERNAME=root        変更後：DB_USERNAME=laravel_user
            変更前：DB_PASSWORD=            変更後：DB_PASSWORD=laravel_pass
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
![Test1](https://github.com/user-attachments/assets/46f289b2-4720-4090-8993-d3501a0336f3)

## URL
    - 開発環境：http://localhost/
    - phpMyAdmin：http://localhost:8080/

## その他
    - contactsテーブルで、category_idはnotnull指定のため、category_idが削除されたときに該当category_idを含むレコードが自動で削除されるようにcascadeDeleteを付けた（マイグレーションファイル2025_05_02_123732_create_contacts_table.php）。
    - お問い合わせフォームの入力画面において、性別はデフォルトで男性を選択することにしているため、「性別を選択してください」というエラーは出現しない。
    - お問い合わせフォームの入力画面において、電話番号の入力欄は画像イメージ通り３つ設けた。３つの欄のうち１つでも空欄があれば「電話番号を入力してください」、1つでも半角数字ではないもしくはハイフンなしの欄があれば「電話番号は5桁までの数字で入力してください」というエラーを表示する仕様とした。
    - 登録ページでは、登録が完了したらログインページに遷移するようにした。
    - 登録ページ・ログインページにおいては、バリデーションにフォームリクエストを使用する指定である。Fortifyのバリデーションは利用せず、Fortifyが提供するサービスプロバイダやインターフェースを活用ながら自身で作ったフォームリクエスト（UserRequest.php, LoginRequest.php）を利用するため、AuthController.phpを作成した。
    - 確認テスト課題ページの「注意点」に、「カラム名はスネークケース、複数形で命名できているか」と記載があるが、「テーブル仕様書」のカラム名は単数形で指定されていたため、カラム名はテーブル仕様書と同一の単数形とした。

## 画面例
    - 登録ページ
![01_register](https://github.com/user-attachments/assets/d9e44554-5b73-4614-b324-4a47b4129482)

    - 登録ページ（バリデーション例）
![02_register-validation](https://github.com/user-attachments/assets/dd998a0c-c7b3-4673-aa95-fe513ef78eea)

    - ログインページ
![03_login](https://github.com/user-attachments/assets/7841547f-28d4-4618-8906-70c8363427dc)

    - ログインページ（バリデーション例）
![04_login-validation](https://github.com/user-attachments/assets/3b63580c-8a9a-4093-a237-e74ced7dd73f)

    - 管理画面
![05_admin](https://github.com/user-attachments/assets/792066a8-83b1-4a0a-b7db-3faf1219807b)

    - 管理画面（検索結果）
![06_admin-search](https://github.com/user-attachments/assets/fd5c3e89-9a56-4715-9832-bb6c077688a4)

    - 管理画面（モーダルウィンドウ）
![07-admin-modal](https://github.com/user-attachments/assets/b21b15f7-cf80-43a3-8c6a-8a12ad63990d)

    - CSVエクスポート
![08_admin-csv](https://github.com/user-attachments/assets/36f2cce0-dfa3-4a81-a8c5-7cf2954a0409)

    - CSVエクスポート（検索結果）
![09_admin-csv-search](https://github.com/user-attachments/assets/8e257b26-3012-4873-bc99-0a0c78d34e24)

    - お問い合わせフォームの入力画面
![10_contact](https://github.com/user-attachments/assets/038272de-0061-48cf-9e6a-4ddf9042a264)

    - お問い合わせフォームの入力画面（バリデーション）
![11_contact-validation](https://github.com/user-attachments/assets/bcb4f68d-8272-4443-a254-9abc99d7c34c)

    - お問い合わせフォームの確認画面
![12_confirm](https://github.com/user-attachments/assets/2606fd10-acff-4dab-97cd-eccb5f3bc19b)

    - サンクスページ
![13_thanks](https://github.com/user-attachments/assets/53ed9c24-660e-494e-95f9-572fd9d1587a)
