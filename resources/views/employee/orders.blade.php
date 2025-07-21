@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-orange">Manage Orders</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($orders->isEmpty())
            <p>No orders available for your restaurants.</p>
        @else

            @foreach ($orders as $order)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Order ID: {{ $order->id }}</h5>
                        <p>Total Amount: ${{ $order->total_amount }}</p>
                        <p>Status: {{ $order->status }}</p>

                        @if ($order->customer)
                            <p><strong>Customer Email:</strong> {{ $order->customer->Email }}</p>
                            <p><strong>Customer Phone:</strong> {{ $order->customer->PhoneNo }}</p>
                            <p><strong>Customer Address:</strong> {{ $order->customer->Address ?? 'No address available' }}</p>
                        @else
                            <p>No customer info available.</p>
                        @endif
                    </div>
                </div>
            @endforeach

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Restaurant</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Change Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->restaurant->name }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>${{ $order->total_amount }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <form action="{{ route('employee.orders.updateStatus', $order) }}" method="POST">
                                @csrf
                                <select name="status" class="form-select form-select-sm d-inline w-auto">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                                    <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-orange">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ route('employee.dashboard') }}" class="text-orange">Back to Dashboard</a>
    </div>

    <style>
        .text-orange {
            color: #FF7B25;
        }
        .btn-orange {
            background-color: #FF7B25;
            color: #FFF3E0;
            border: none;
        }
        .btn-orange:hover {
            background-color: #e96b0b;
        }
    </style>
@endsection
