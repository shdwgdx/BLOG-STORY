<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Ищем пользователя в базе данных
        $admin = User::where('email', $email)->first();

        // Проверяем, существует ли пользователь и верен ли пароль
        if ($admin && $password == $admin->password) {
            // Аутентификация прошла успешно, перенаправляем на дашборд
            Auth::login($admin);
            return redirect()->intended('admin');
        }



        return back()->withErrors([
            'email' => 'Неверные учетные данные.',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
    public function index()
    {
        return redirect('/admin/articles');
    }
}
