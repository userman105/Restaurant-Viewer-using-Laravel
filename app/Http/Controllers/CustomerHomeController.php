<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant; // Assuming you have a Restaurant model

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = Restaurant::query();


        if ($request->has('cuisine_type') && $request->cuisine_type) {
            $query->where('cuisine_type', $request->cuisine_type);
        }


        $restaurants = $query->orderBy('id', 'asc')->get();

        return view('customer.main', compact('restaurants'));
    }

}
