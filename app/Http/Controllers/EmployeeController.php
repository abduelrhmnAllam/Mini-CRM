<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        if (!auth('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'يجب تسجيل الدخول كأدمن أولاً');
        }

        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create employee
        Employee::create([
            'admin_id' => auth('admin')->id(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('employees.index')->with('success', 'تم إضافة الموظف بنجاح');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.edit', compact('employee'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف بنجاح');
    }

    public function createCustomer()
    {
        if (!Auth::guard('employee')->check()) {
            return redirect()->route('employee.login')->with('error', 'يجب تسجيل الدخول كموظف أولاً');
        }

        return view('employee.customers.create');
    }

    public function storeCustomer(Request $request)
    {
        if (!Auth::guard('employee')->check()) {
            return redirect()->route('employee.login')->with('error', 'يجب تسجيل الدخول كموظف أولاً');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'nullable|regex:/^01[0-9]{9}$/',
        ]);

        $employee = Auth::guard('employee')->user();

        Customer::create([
            'employee_id' => $employee->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Create the user record in the users table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('123456789'),
        ]);

        return redirect()->route('employee.customers')->with('success', 'تم إضافة العميل بنجاح');
    }

    public function editCustomer($id)
    {

        $customer = Customer::where('employee_id', auth()->guard('employee')->id())->findOrFail($id);
        return view('employee.customers.edit', compact('customer'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,' . $id,
            'phone' => 'nullable|regex:/^01[0-9]{9}$/',
        ]);

        $customer = Customer::where('employee_id', auth()->guard('employee')->id())->findOrFail($id);
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('employee.customers')->with('success', 'تم تعديل بيانات العميل بنجاح');
    }

    public function destroyCustomer($id)
    {
        $customer = Customer::where('employee_id', auth()->guard('employee')->id())->findOrFail($id);
        $customer->delete();

        return redirect()->route('employee.customers')->with('success', 'تم حذف العميل بنجاح');
    }

    public function getEmployeeCustomers()
    {
        if (!auth()->guard('employee')->check()) {
            return redirect()->route('employee.login')->with('error', 'يجب تسجيل الدخول كموظف أولاً');
        }

        $employee = auth()->guard('employee')->user();
        $customers = Customer::where('employee_id', $employee->id)->get();

        return view('employee.customers.index', compact('customers'));
    }
}
