<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request)
    {


        $cart = session()->get('cart', []);

        $itemId = $request->input('item_id');
        $restaurantId = $request->input('restaurant_id');
        $quantity = (int)$request->input('quantity', 1);


        $menuItem = \App\Models\MenuItem::findOrFail($itemId);


        $cart[$itemId] = [
            'item_id' => $itemId,
            'restaurant_id' => $restaurantId,
            'quantity' => $quantity,
            'price' => $menuItem->price,
            'name' => $menuItem->name,
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Item added to cart.');
    }

    public function checkout(Request $request)
    {
        global $customer;
        $cart = session('cart', []);
        if (empty($cart) || !is_array($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $total = 0;
        $restaurantId = null;

        foreach ($cart as $item) {
            if (!is_array($item) || !isset($item['price'], $item['quantity'])) {
                continue;
            }

            $total += $item['price'] * $item['quantity'];
            $restaurantId = $item['restaurant_id'] ?? $restaurantId;
        }

        if ($restaurantId === null || $total == 0) {
            return back()->with('error', 'Something went wrong with your cart.');
        }

        $customer = DB::table('customers')->where('CustomerID', Auth::id())->first();
        $address = $customer->Address ?? 'No address on file';
        $order = Order::create([

            'restaurant_id'    => $restaurantId,
            'user_id'          => Auth::id(),
            'total_amount'     => $total,
            'status'           => 'pending',
            'delivery_address' => $customer->Address,
        ]);



        if (!empty($cart)) {
            $existingRestaurantId = reset($cart)['restaurant_id'] ?? null;
            if ($existingRestaurantId !== $restaurantId) {
                $cart = [];
            }
        }

        session()->forget('cart');

        return redirect()->route('customer.main')->with('success', 'Order placed successfully!');
    }
    public function index()
    {
        $orders = \App\Models\Order::where('user_id', Auth::id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

}
