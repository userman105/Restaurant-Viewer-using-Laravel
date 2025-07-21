@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="text-orange mb-4">Attach Menu Item to Restaurant</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('employee.menu_items.attach') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="restaurant_id" class="form-label fw-bold text-orange">Select Restaurant</label>
                <select name="restaurant_id" class="form-select border-orange" required>
                    @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="menu_item_id" class="form-label fw-bold text-orange">Select Menu Item</label>
                <select name="menu_item_id" class="form-select border-orange" required>
                    @foreach($menuItems as $menuItem)
                        <option value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-orange">Attach Menu Item</button>
        </form>
        <a href="{{ route('employee.dashboard') }}" class="text-orange">Back to Dashboard</a>
    </div>

    <style>
        .text-orange { color: #FF7B25; }
        .border-orange { border: 1px solid #FF7B25; }
        .btn-orange { background-color: #FF7B25; color: white; }
        .btn-orange:hover { background-color: #e96b0b; }
    </style>
@endsection
