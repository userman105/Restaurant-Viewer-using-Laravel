@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">My Reservations</h2>

        @if($reservations->count())
            <div class="list-group">
                @foreach($reservations as $reservation)
                    <div class="list-group-item">
                        <strong>Restaurant #{{ $reservation->restaurant_id }}</strong><br>
                        Date: {{ $reservation->date }}<br>
                        Time: {{ $reservation->time }}<br>
                        Guests: {{ $reservation->guests }}<br>
                        Status: {{ ucfirst($reservation->status) }}
                    </div>
                @endforeach
            </div>

            <a href="{{ route('customer.main') }}" class="btn btn-orange">
                Main Page
            </a>

        @else
            <p class="text-muted">You have no reservations yet.</p>
        @endif
    </div>
@endsection
