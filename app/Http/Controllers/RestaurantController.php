<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
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
     * Handle the reservation request.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function reserve($id)
    {


        return view('restaurants.reserve', ['restaurant_id' => $id]);
    }


    /**
     * Handle the order request.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function order($restaurantId)
    {
        $menuItems = MenuItem::whereHas('restaurants', function($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })->get();

        return view('restaurants.order', compact('restaurantId', 'menuItems'), [
            'restaurant_id' => $restaurantId,
            'menuItems' => $menuItems,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'items' => 'required|array',
            'items.*' => 'integer|min:0',
        ]);

        $total = 0;
        $items = [];

        foreach ($data['items'] as $menuItemId => $quantity) {
            if ($quantity > 0) {
                $menuItem = MenuItem::findOrFail($menuItemId);
                $items[] = ['menu_item_id' => $menuItem->id, 'quantity' => $quantity, 'price' => $menuItem->price];
                $total += $menuItem->price * $quantity;
            }
        }

        $order = Order::create([
            'restaurant_id' => $data['restaurant_id'],
            'user_id' => auth()->id(),
            'total_amount' => $total,
            'status' => 'pending',
            'delivery_address' => auth()->user()->customer->Address ?? null,
        ]);

        foreach ($items as $item) {
            $order->orderItems()->create($item);
        }

        return redirect()->route('customer.main');
    }



}
