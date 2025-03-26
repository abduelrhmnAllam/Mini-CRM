<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\Auth\EmployeeAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;


        Route::get('/', function () { return view('welcome');});

        // Admin Login Routs
        Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
        Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/admin/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
            Route::resource('employees', EmployeeController::class);
            Route::resource('customers', CustomerController::class);
            Route::post('customers/assign', [CustomerController::class, 'assign'])->name('customers.assign');
            Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
        });
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
            Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
            Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
            Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
            Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
            Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
            Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

        });

  // Empolyee Login Routs
      Route::get('/employee/login', [EmployeeAuthController::class, 'showLoginForm'])->name('employee.login');
      Route::post('/employee/login', [EmployeeAuthController::class, 'login'])->name('employee.login.post');
      Route::post('/employee/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');


     Route::middleware(['auth:employee'])->group(function () {

             Route::get('/employee/dashboard', function () { return view('employee.dashboard'); })->name('employee.dashboard');
             Route::get('/employee/profile', [EmployeeController::class, 'profile'])->name('employee.profile');
             Route::get('/employee/customers/{customer}/actions/create', [ActionController::class, 'create'])->name('employee.customers.actions.create');
             Route::get('/employee/customers', [EmployeeController::class, 'getEmployeeCustomers'])->name('employee.customers.index');
             Route::post('/employee/customers/{customer}/actions', [ActionController::class, 'store'])->name('employee.customers.actions.store');
             Route::get('/employee/customers/actions', [ActionController::class, 'allActions'])->name('employee.customers.actions.all');    Route::get('/my-customers', [CustomerController::class, 'getEmployeeCustomers'])->name('employee.customers');
             Route::post('/employee/customers/{customer}/actions', [ActionController::class, 'store'])->name('employee.customers.actions.store');
             Route::get('/customers/create', [EmployeeController::class, 'createCustomer'])->name('employee.customers.create');
             Route::post('/customers/store', [EmployeeController::class, 'storeCustomer'])->name('employee.customers.store');
             Route::get('/customers/{id}/edit', [EmployeeController::class, 'editCustomer'])->name('employee.customers.edit');
             Route::post('/customers/{id}/update', [EmployeeController::class, 'updateCustomer'])->name('employee.customers.update');
             Route::delete('/customers/{id}/destroy', [EmployeeController::class, 'destroyCustomer'])->name('employee.customers.destroy');

        });

      // User Routs
     Route::middleware(['auth:web'])->group(function () {
        Route::get('/dashboard', function () {return view('dashboard'); })->name('dashboard');
    
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });




require __DIR__.'/auth.php';
