<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Petugas;

class HomeController extends Controller
{
    public function index(){
        return view('admin.home');
    }
}
