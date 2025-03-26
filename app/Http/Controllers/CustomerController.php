<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::with('employee')->get();
        $employees = Employee::all();
        return view('admin.customers.index', compact('customers', 'employees'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('admin.customers.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email|unique:users,email',
            'phone' => 'nullable|regex:/^([0-9]{11})$/',
            'employee_id' => 'required|exists:employees,id',
        ]);

        // Create the customer record
        $customer = Customer::create([
            'admin_id' => auth()->user()->id,
            'employee_id' => $request->employee_id,
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

        return redirect()->route('customers.index')->with('success', 'Customer added successfully and user account created.');
    }

    public function edit($id)
    {
            $customer = Customer::findOrFail($id);
            $employees = Employee::all();
            return view('admin.customers.edit', compact('customer', 'employees'));
    }

     public function update(Request $request, $id)
     {
         $customer = Customer::findOrFail($id);

         $customer->update([
             'name' => $request->name,
             'email' => $request->email,
             'phone' => $request->phone,
             'employee_id' => $request->employee_id,
         ]);

         return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
     }

     public function destroy($id)
     {
         $customer = Customer::findOrFail($id);
         $customer->delete();

         return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
     }

     public function getEmployeeCustomers()
     {
         if (!auth()->guard('employee')->check()) {
             return redirect()->route('employee.login')->with('error', 'يجب تسجيل الدخول كموظف أولاً');
         }

         $employee = auth()->guard('employee')->user();
         $customers = Customer::where('employee_id', $employee->id)->with('actions') ->get();

         return view('employee.customers.index', compact('customers'));
     }


}
