<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function showMenuItems()
    {
        $user = auth()->user();

        $restaurants = $user->restaurants;


        $menuItems = MenuItem::all();

        return view('employee.menu_items', compact('restaurants', 'menuItems'));
    }

    public function attachMenuItem(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'menu_item_id' => 'required|exists:menu_items,id',
        ]);


        DB::table('menu_item_restaurant')->insert([
            'restaurant_id' => $request->restaurant_id,
            'menu_item_id' => $request->menu_item_id,
        ]);

        return redirect()->route('employee.menu_items')->with('success', 'Menu item attached successfully!');
    }

    public function myReservations()
    {
        // Fetch restaurant IDs the employee is linked to
        $employeeRestaurants = DB::table('restaurant_employee')
            ->where('user_id', auth()->id())  // Match current employee (logged-in user)
            ->pluck('restaurant_id');  // Get restaurant IDs

        // Get reservations where the restaurant_id is in the list of employee's linked restaurants
        $reservations = Reservation::whereIn('restaurant_id', $employeeRestaurants)
            ->with('customer')  // Load customer relationship if needed
            ->get();

        return view('employee.reservations', compact('reservations'));
    }

    public function updateReservation(Request $request, Reservation $reservation)
    {
        // Fetch restaurant IDs that the employee is linked to
        $employeeRestaurants = DB::table('restaurant_employee')
            ->where('user_id', auth()->id())
            ->pluck('restaurant_id');  // Get restaurant IDs

        // If the reservation's restaurant_id is not in the list of restaurants the employee is linked to, abort
        if (!$employeeRestaurants->contains($reservation->restaurant_id)) {
            abort(403);  // Forbidden access
        }

        // Validate and update reservation status
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('employee.reservations')->with('success', 'Reservation status updated successfully.');
    }

    public function joinRestaurantForm()
    {
        return view('employee.joinRestaurant');
    }

    public function joinRestaurant(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);


        $user = auth()->user();


        DB::table('restaurant_employee')->insert([
            'restaurant_id' => $request->restaurant_id,
            'user_id' => $user->id,
        ]);


        $employee = $user->employee;
        $employee->first_time_login = false;
        $employee->save();

        return redirect()->route('employee.dashboard')->with('success', 'Joined restaurant successfully!');
    }

}
