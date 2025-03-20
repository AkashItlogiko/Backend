<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /** 
     * Fetch and display today yesterday this month this year orders.
    */
    public function index()
    {
        //get today's orders
        
        $todayOrders= Order::whereDay('created_at',Carbon::today())->get();
        $yesterdayOrders= Order::whereDay('created_at',Carbon::yesterday())->get();
        $monthOrders= Order::whereMonth('created_at',Carbon::now()->month)->get();
        $yearOrders= Order::whereYear('created_at',Carbon::now()->year)->get();

        return view('admin.index')->with([
            'todayOrders'=>$todayOrders,
            'yesterdayOrders'=>$yesterdayOrders,
            'monthOrders'=>$monthOrders,
            'yearOrders'=>$yearOrders,
        ]);
    } 
    
/**
 *Display the login from
 */

    public function login()
    {
        if(!auth()->guard('admin')->check())
        {
            return view('admin.login');
        }
        return redirect()->route(admin.index);
    }

/**
 *Auth the admin 
 */

    public function auth(AuthAdminRequest $request)
    {
        if($request->validated())
        {
            if(auth()->guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])){
                $request->session()->regenerate();
                return redirect()->route(admin.index);
            }else{
                 return redirect()->route(admin.index);
            }
        }
   
    }

}
