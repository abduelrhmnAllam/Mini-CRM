<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
class ActionController extends Controller
{
    public function create($customerId)
    {
        if (!auth()->guard('employee')->check()) {
            return redirect()->route('employee.login')->with('error', 'يجب تسجيل الدخول كموظف أولاً');
        }

        $customer = Customer::findOrFail($customerId);

        return view('employee.actions.create', compact('customer'));
    }
    public function allActions()
    {
        if (!auth()->guard('employee')->check()) {
            return redirect()->route('employee.login')->with('error', 'يجب تسجيل الدخول كموظف أولاً');
        }

        $employee = auth()->guard('employee')->user();


        $actions = Action::whereHas('customer', function ($query) use ($employee) {
            $query->where('employee_id', $employee->id);
        })->latest()->get();

        return view('employee.actions.index', compact('actions'));
    }

    public function store(Request $request, $customerId)
    {
        if (!auth()->guard('employee')->check()) {
            return redirect()->route('employee.login')->with('error', 'يجب تسجيل الدخول كموظف أولاً');
        }

        $request->validate([
            'type' => 'required|in:call,visit,follow_up',
            'result' => 'nullable|string',
        ]);

        $employee = auth()->guard('employee')->user();


        $customer = Customer::where('id', $customerId)
            ->where('employee_id', $employee->id)
            ->firstOrFail();

            
        Action::create([
            'customer_id' => $customer->id,
            'employee_id' => $employee->id,
            'type' => $request->type,
            'result' => $request->result,
        ]);

        return redirect()->route('employee.customers.index')->with('success', 'تم إضافة الإجراء بنجاح');
    }
}
