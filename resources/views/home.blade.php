@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Welcome to Restaurant Finder</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 bg-light">
                            <h5>Hello, {{ Auth::user()->name }}!</h5>
                            <p>Discover amazing restaurants and place your orders or make reservations.</p>
                        </div>

                        <div class="restaurant-list">
                            @foreach($restaurants as $restaurant)
                                <div class="restaurant-item p-4 border-bottom">
                                    <div class="row">
                                        <div class="col-md-2 mb-3 mb-md-0">
                                            <img src="{{ $restaurant->image ?? 'https://via.placeholder.com/150' }}" alt="{{ $restaurant->name }}" class="img-fluid rounded">
                                        </div>
                                        <div class="col-md-7 mb-3 mb-md-0">
                                            <h5 class="restaurant-name">{{ $restaurant->name }}</h5>
                                            <div class="restaurant-cuisine text-muted mb-2">
                                                {{ $restaurant->cuisine_type }} • {{ $restaurant->rating }} ★ •
                                                <span class="text-success">{{ $restaurant->price_range_formatted }}</span>
                                            </div>
                                            <p class="restaurant-description mb-2">{{ $restaurant->description }}</p>
                                            <div class="restaurant-details small text-muted">
                                                <div><i class="bi bi-geo-alt-fill"></i> {{ $restaurant->address }}, {{ $restaurant->city }}</div>
                                                <div><i class="bi bi-clock-fill"></i> {{ $restaurant->opening_hours }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex flex-column justify-content-center">
                                            @if($restaurant->reservation_available)
                                                <a href="{{ route('restaurants.reserve', $restaurant->id) }}" class="btn btn-outline-primary mb-2">
                                                    <i class="bi bi-calendar-check"></i> Reserve
                                                </a>
                                            @else
                                                <button class="btn btn-outline-secondary mb-2" disabled>
                                                    <i class="bi bi-calendar-x"></i> No Reservations
                                                </button>
                                            @endif

                                            @if($restaurant->delivery_available || $restaurant->takeout_available)
                                                <a href="{{ route('restaurants.order', $restaurant->id) }}" class="btn btn-primary">
                                                    <i class="bi bi-bag"></i> Order Now
                                                </a>
                                            @else
                                                <button class="btn btn-secondary" disabled>
                                                    <i class="bi bi-bag-x"></i> No Ordering
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="p-4">
                            {{ $restaurants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .restaurant-list {
            max-height: 600px;
            overflow-y: auto;
        }

        .restaurant-item {
            transition: background-color 0.2s;
        }

        .restaurant-item:hover {
            background-color: #f8f9fa;
        }

        .restaurant-name {
            color: #333;
            font-weight: 600;
        }

        .restaurant-cuisine {
            font-size: 0.9rem;
        }

        .restaurant-description {
            color: #555;
        }

        .restaurant-details {
            color: #777;
        }
    </style>
@endsection
