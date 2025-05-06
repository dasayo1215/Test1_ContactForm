<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request){
        $contact = $request->only(['last_name','first_name','gender','email','tel1','tel2','tel3','address','building','category_id','detail']);

        //入力値をセッションに保存
        $request->session()->put('form_input', $contact);
        //名前を連結
        $contact['name'] = $contact['last_name'] . "　" . $contact['first_name'];
        // 電話番号を連結
        $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];

        //カテゴリ内容の取得
        $category = Category::find($contact['category_id']);
        $contact['category_content'] = $category->content;

        return view('confirm', compact('contact'));
    }

    public function fix(Request $request) {
        $inputs = $request->session()->get('form_input');
        return redirect()->route('index')->withInput($inputs);
    }

    public function store(Request $request){
        // dd($request->all());
        $contact = $request->only(['last_name','first_name','gender','email','tel','address','building','category_id','detail']);
        Contact::create($contact);
        return view('thanks');
    }
}
