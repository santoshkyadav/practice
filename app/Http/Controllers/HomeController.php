<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
//        $allEvents = Category::get();
//        return view('dashboard',compact(['allEvents']));
    }

    public function user_dashboard()
    {
        $users = Auth::user();
        return view('userDashboard',compact(['users']));
    }
//    public function customer_dashboard()
//    {
//        $allfolders = Category::get();
//        return view('userDashboard',compact(['allfolders']));
//    }
}
