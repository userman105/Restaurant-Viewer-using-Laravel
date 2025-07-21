<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = $user->employee;

        return view('employee.dashboard', compact('employee'));
    }

    public function store(Request $request)
    {
        Log::info('Restaurant creation request data:', $request->all());

        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not authenticated.']);
        }

        Log::info('Authenticated user:', ['user_id' => $user->id]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cuisine_type' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'opening_hours' => 'required|string|max:255',
            'price_range' => 'nullable|integer|min:1|max:4',
            'featured' => 'nullable|boolean',
            'image' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'delivery_available' => 'nullable|boolean',
            'takeout_available' => 'required|boolean',
            'reservation_available' => 'required|boolean',
        ]);

        $validated['featured'] = $request->has('featured') ? true : false;
        $validated['delivery_available'] = $request->has('delivery_available') ? true : false;
        $validated['price_range'] = $request->input('price_range', 1);
        $validated['rating'] = 0.0;
        $validated['latitude'] = $validated['latitude'] ?? null;
        $validated['longitude'] = $validated['longitude'] ?? null;

        try {
            $restaurant = Restaurant::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'cuisine_type' => $validated['cuisine_type'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postal_code' => $validated['postal_code'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'website' => $validated['website'],
                'opening_hours' => $validated['opening_hours'],
                'price_range' => $validated['price_range'],
                'featured' => $validated['featured'],
                'image' => $validated['image'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'delivery_available' => $validated['delivery_available'],
                'takeout_available' => $validated['takeout_available'],
                'reservation_available' => $validated['reservation_available'],
                'employee_id' => $user->id
            ]);

            $user = Auth::user();
            $restaurant->employees()->attach($user->id);

            $employee = $user->employee;
            $employee->first_time_login = false;
            $employee->save();;
            return redirect()->route('employee.dashboard')->with('success', 'Restaurant created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating restaurant: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create restaurant: ' . $e->getMessage()]);
        }
    }

    public function myRestaurants()
    {
        $user = Auth::user();
        $restaurants = $user->restaurants;

        return view('employee.my_restaurants', compact('restaurants'));
    }

    public function orders()
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants()->pluck('restaurants.id');
        $orders = Order::whereIn('restaurant_id', $restaurantIds)
            ->with('customer')
            ->get();

        return view('employee.orders', compact('orders'));
    }



    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('employee.orders')->with('success', 'Order status updated successfully.');
    }




}

