<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
// داخل AdminController
public function profile()
{
    return view('admin.profile');
}


}
