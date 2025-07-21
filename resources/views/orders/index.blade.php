@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">My Orders</h3>

        @forelse ($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Order #{{ $order->id }}</h5>
                    <p>Status: <strong>{{ ucfirst($order->status) }}</strong></p>
                    <p>Total: ${{ number_format($order->total_amount, 2) }}</p>
                    <p>Delivery Address: {{ $order->delivery_address }}</p>
                    <small class="text-muted">Ordered on {{ $order->created_at->format('M d, Y h:i A') }}</small>
                </div>
            </div>

            <a href="{{ route('customer.main') }}" class="btn btn-orange">
                Main Page
            </a>

        @empty
            <p>You have no orders yet.</p>
        @endforelse
    </div>
@endsection
