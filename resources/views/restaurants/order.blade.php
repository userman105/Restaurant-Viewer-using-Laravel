@extends('layouts.app')

@section('content')
    <style>
        .bg-orange {
            background-color: #fd7e14 !important;
        }

        .text-orange {
            color: #fd7e14 !important;
        }

        .btn-orange {
            background-color: #fd7e14;
            color: white;
            border: none;
        }

        .btn-orange:hover {
            background-color: #e96b0b;
        }

        .btn-outline-orange {
            border-color: #fd7e14;
            color: #fd7e14;
        }

        .btn-outline-orange:hover {
            background-color: #fd7e14;
            color: white;
        }

        .badge-orange {
            background-color: #fd7e14;
            color: white;
        }
    </style>


    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-orange text-white">
                        <h4 class="mb-0">Place an Order</h4>
                    </div>
                    <div class="card-body">

                        <h5 class="text-orange">Menu for Restaurant #{{ $restaurant_id }}</h5>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="menu-items mb-4">
                            <div class="list-group">
                                @forelse($menuItems as $item)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $item->name }}</h6>
                                            <small class="text-muted">{{ $item->description }}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                        <span class="badge badge-orange rounded-pill me-2">
                                            ${{ number_format($item->price, 2) }}
                                        </span>
                                            <form method="POST" action="{{ route('cart.add') }}">
                                                @csrf
                                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                <input type="hidden" name="restaurant_id" value="{{ $restaurant_id }}">
                                                <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm me-2" style="width: 60px;">
                                                <button type="submit" class="btn btn-sm btn-outline-orange">Add</button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">No menu items available for this restaurant.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="order-summary mb-4">
                            <h5>Your Order</h5>
                            <div class="card">
                                <div class="card-body">
                                    @if(session('cart') && count(session('cart')) > 0)
                                        <ul class="list-group mb-3">
                                            @foreach(session('cart') as $itemId => $item)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        Item #{{ $itemId }} — Quantity: {{ $item['quantity'] ?? 'N/A' }}
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-center text-muted">Your cart is empty</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            @if(session('cart') && count(session('cart')) > 0)
                                <form method="POST" action="{{ route('order.checkout') }}">
                                    @csrf
                                 }
                                    <button type="submit" class="btn btn-orange">Proceed to Checkout</button>
                                </form>
                            @else
                                <button type="button" class="btn btn-orange" disabled>Proceed to Checkout</button>
                            @endif
                                <a href="{{ route('customer.main') }}" class="btn btn-outline-orange mt-2">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

