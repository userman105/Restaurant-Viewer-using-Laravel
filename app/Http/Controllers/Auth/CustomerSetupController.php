<?php

namespace App\Http\Controllers\Auth;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerSetupController extends Controller
{
    public function showForm()
    {
        return view('auth.customer_setup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'CustomerFName' => 'required|string|max:30',
            'CustomerLName' => 'required|string|max:30',
            'PhoneNo'       => 'nullable|string|max:11|unique:customers,PhoneNo',
            'Address'       => 'nullable|string|max:50',
            'Email'         => 'nullable|email|max:30',
        ]);

        DB::table('customers')->insert([
            'CustomerID'    => Auth::id(),
            'CustomerFName' => $request->CustomerFName,
            'CustomerLName' => $request->CustomerLName,
            'PhoneNo'       => $request->PhoneNo,
            'Address'       => $request->Address,
            'Email'         => $request->Email,
        ]);

        DB::table('orders')
            ->where('user_id', Auth::id())
            ->whereNull('delivery_address')
            ->update(['delivery_address' => $request->Address]);

        return redirect('customer/main')->with('status', 'Account setup complete!');
    }
    public function home()
    {



    }


}
