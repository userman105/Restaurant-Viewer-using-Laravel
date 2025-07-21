@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-orange">My Restaurants</h2>

        @if($restaurants->isEmpty())
            <p>You are not associated with any restaurants yet.</p>
        @else
            <div class="row">
                @foreach ($restaurants as $restaurant)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-orange">
                            <div class="card-body">
                                <h5 class="card-title text-orange">{{ $restaurant->name }}</h5>
                                <p class="card-text">{{ $restaurant->description }}</p>
                                <p class="card-text"><strong>City:</strong> {{ $restaurant->city }}</p>
                                <p class="card-text"><strong>Cuisine:</strong> {{ $restaurant->cuisine_type }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <a href="{{ route('employee.dashboard') }}" class="text-orange">Back to Dashboard</a>
    </div>

    <style>
        .text-orange {
            color: #FF7B25;
        }
        .border-orange {
            border: 1px solid #FF7B25;
        }
    </style>
@endsection
