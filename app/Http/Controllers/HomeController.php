<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $profits = Auth::user()->profits->where('date','<=', date("Y-m-d H:i:s"))->sum('value');
        $expenses = Auth::user()->expenses->where('date','<=', date("Y-m-d H:i:s"))->sum('value');
        $balance = $profits - $expenses;

        $investments = Auth::user()->applications->sum('value')/100;

        $expected_investments = Auth::user()->applications->avg('expected');

        return view('home', compact('balance', 'investments', 'expected_investments'));
    }
}
