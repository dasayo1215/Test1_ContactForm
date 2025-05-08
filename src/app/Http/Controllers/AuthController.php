<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }

    //登録処理：Fortifyのバリデーションは利用せず（CreateNewUser.phpを修正）、フォームリクエストを利用
    public function register(UserRequest $request){
        $data = $request->validated();

        //Fortifyでユーザー作成
        $usr = app(CreatesNewUsers::class)->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        //ログイン画面へ
        return redirect()->route('login');
    }

    public function showLogin(){
        return view('auth.login');
    }

    //ログイン処理：Fortifyのバリデーションは利用せず（CreateNewUser.phpを修正）、フォームリクエストを利用
    public function login(LoginRequest $request){
        $data = $request->validated();

        // Fortifyのログイン機能を利用
        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            // ログイン成功時
            return redirect()->route('admin');
        }

        // ログイン失敗時（バリデーションは通ったが認証失敗）
        return back()->withErrors([
            'password' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->withInput();
    }

    public function admin(Request $request) {
        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();

        $detailContact = null;
        if ($request->has('modal_detail')) {
            $detailContact = Contact::with('category')->find($request->modal_detail);
        }

        return view('auth.admin', compact('contacts', 'categories', 'detailContact'));
    }

    public function search(Request $request) {
        $contacts = Contact::with('category')
            ->GenderSearch($request->gender)
            ->CategorySearch($request->category_id)
            ->DateSearch($request->date)
            ->KeywordSearch($request->keyword)
            ->Paginate(7)
            ->appends($request->all());
        $categories = Category::all();

        $detailContact = null;
        if ($request->has('modal_detail')) {
            $detailContact = Contact::with('category')->find($request->modal_detail);
        }

        return view('auth.admin', compact('contacts', 'categories', 'detailContact'));
    }

    public function export(Request $request) {
        $contacts = Contact::with('category')
            ->GenderSearch($request->gender)
            ->CategorySearch($request->category_id)
            ->KeywordSearch($request->keyword)
            ->DateSearch($request->date)
            ->get();

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM を出力（Excel用）
            echo chr(0xEF) . chr(0xBB) . chr(0xBF);

            // CSVのヘッダー
            fputcsv($handle, ['お問い合わせID', '姓', '名', '性別', 'メール', '電話', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容', '登録日', '更新日']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->last_name,
                    $contact->first_name,
                    $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                    $contact->email,
                    '="' . $contact->tel . '"',
                    $contact->address,
                    $contact->building,
                    $contact->category->content,
                    $contact->detail,
                    $contact->created_at->format('Y-m-d H:i:s'),
                    $contact->updated_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        });

        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }

    public function delete(Request $request, $id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        // 検索条件をクエリパラメータとして引き継いで search にリダイレクト
        return redirect()->route('search', $request->query());
    }
}
