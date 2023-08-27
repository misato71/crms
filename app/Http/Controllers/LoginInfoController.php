<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginInfoRequest;
use App\Http\Requests\UpdateLoginInfoRequest;
use App\Models\LoginInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class LoginInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     *  認証画面表示
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'status' => session('status'),
        ]);
    }

    /**
     * 認証の試行を処理
     */
    public function store(StoreLoginInfoRequest $request)
    {
        $request->validate([
            'user_id' => ['required', 'email'],
            'staff_password' => ['required'],
        ]);

        if (Auth::attempt(['user_id' => $request->user_id, 'staff_password' => $request->staff_password, 'password' => $request->staff_password])) {
            $request->session()->regenerate();

            // return redirect()->intended('dashboard');
            return Inertia::render('customers.index');
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません',
        ])->onlyInput('email');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(LoginInfo $loginInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoginInfo $loginInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoginInfoRequest $request, LoginInfo $loginInfo)
    {
        //
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
