<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class EmployeeAuthController extends Controller
{
    // عرض فورم تسجيل الدخول
    public function showLoginForm()
    {
        return view('auth.employee-login');
    }

    // تنفيذ عملية تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('employee')->attempt($credentials)) {
            return redirect()->route('employee.dashboard'); // توجيه الموظف للوحة التحكم الخاصة به
        }

        return back()->withErrors(['email' => 'بيانات تسجيل الدخول غير صحيحة']);
    }


    // تسجيل الخروج
    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login')->with('success', 'تم تسجيل الخروج بنجاح!');
    }
}
