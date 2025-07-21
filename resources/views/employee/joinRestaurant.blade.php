@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Join a Restaurant</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('employee.joinRestaurant') }}">
            @csrf
            <div class="mb-3">
                <label for="restaurant_id" class="form-label">Restaurant ID</label>
                <input type="number" name="restaurant_id" class="form-control" required>
            </div>
            <button type="submit" class="btn-orange">Join</button>
        </form>

        <a href="{{ route('employee.dashboard') }}" class="btn btn-orange mt-3">Back to Dashboard</a>
    </div>


    <style>
        .text-orange {
            color: #FF7B25;
        }
        .border-orange {
            border: 1px solid #FF7B25;
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
