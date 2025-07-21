<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request, $restaurant_id)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1|max:10',
            'notes' => 'nullable|string',
        ]);

        Reservation::create([
            'restaurant_id' => $restaurant_id,
            'user_id' => Auth::id(),
            'date' => $request->date,
            'time' => $request->time,
            'guests' => $request->guests,
            'special_requests' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.main')->with('success', 'Reservation created successfully!');
    }

    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())->get();

        return view('reservations.index', compact('reservations'));
    }
}
