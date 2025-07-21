@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-orange">Manage Reservations</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($reservations->isEmpty())
            <p>No reservations found for your restaurants.</p>
        @else
            @foreach ($reservations as $reservation)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Reservation ID: {{ $reservation->id }}</h5>
                    <p>Total Amount: ${{ $reservation->total_amount }}</p>
                    <p>Status: {{ $reservation->status }}</p>

                    @if ($reservation->customer)
                    <p><strong>Customer Email:</strong> {{ $reservation->customer->Email }}</p>
                    <p><strong>Customer Phone:</strong> {{ $reservation->customer->PhoneNo }}</p>
                    <p><strong>Customer Address:</strong> {{ $reservation->customer->Address ?? 'No address available' }}</p>
                    @else
                        <p>No customer info available.</p>
                    @endif
                </div>
            </div>
            @endforeach

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Restaurant ID</th>
                    <th>User ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Guests</th>
                    <th>Special Requests</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)  <!-- Changed from $orders to $reservations -->
                <tr>
                    <td>{{ $reservation->restaurant_id }}</td>
                    <td>{{ $reservation->user_id }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->time }}</td>
                    <td>{{ $reservation->guests }}</td>
                    <td>{{ $reservation->special_requests }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>
                        <form method="POST" action="{{ route('employee.reservations.update', $reservation->id) }}">
                            @csrf
                            @method('PUT')

                            <select name="status" class="form-select mb-2">
                                <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
        .text-orange { color: #FF7B25; }
        .btn-orange { background-color: #FF7B25; color: white; }
        .btn-orange:hover { background-color: #e96b0b; }
    </style>
@endsection
