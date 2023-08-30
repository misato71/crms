<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginInfo;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    // public function create(): Response
    // {
    //     return Inertia::render('Auth/Register');
    // }

    /**
     * ログイン情報　新規登録
     * Illuminate\Http\Request $request メールアドレスとパスワード
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'user_id' => 'required|string|email|max:50|unique:'.LoginInfo::class,
        //     'staff_password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        // $user = LoginInfo::create([
        //     'user_id' => $request->user_id,
        //     'staff_password' => Hash::make($request->staff_password),
        //     'created_id' => Auth::id(),
        // ]);

        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
    }
}
