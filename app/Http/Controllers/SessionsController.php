<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class SessionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
       $credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required'
       ]);

       if (Auth::attempt($credentials, $request->has('remember'))) {
        if(Auth::user()->activated) {
           session()->flash('success', '歡迎回來！');
           $fallback = route('users.show', Auth::user());
           return redirect()->intended($fallback);
       } else {
           Auth::logout();
           session()->flash('warning', '你的帳號未進行認證，請點擊信箱中的郵件進行認證。');
           return redirect('/');
       }
   } else {
       session()->flash('danger', '很抱歉，您的信箱與密碼不匹配');
       return redirect()->back()->withInput();
       }
   }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
