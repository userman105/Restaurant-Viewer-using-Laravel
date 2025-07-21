@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-orange">Employee Dashboard </h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif



        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="mb-4">
            <a href="{{ route('employee.reservations') }}" class="btn btn-orange">
                My Reservations
            </a>
        </div>

        <div class="mb-4">
            <a href="{{ route('employee.orders') }}" class="btn btn-orange">
                My Orders
            </a>
        </div>

        @if (Auth::user()->employee->first_time_login)
            <button id="openDrawerBtn" class="btn btn-orange mb-3">Add New Restaurant</button>
            <a href="{{ route('employee.joinRestaurantForm') }}" id="joinRestaurantBtn" class="btn btn-orange mb-3">Join Restaurant</a>
        @endif

        <div class="mb-4">
            <a href="{{route('employee.menu_items') }}" class="btn btn-orange">
                My Menu Items
            </a>
        </div>


        <div class="mb-4">
            <a href="{{ route('employee.myRestaurants') }}" class="btn btn-orange">
                My Restaurants
            </a>
        </div>

        <div class="mb-4 text-orange">
            <p><strong>Position:</strong> {{ $employee->EmployeePosition }}</p>
        </div>

        <div id="drawer" style="display: none; position: fixed; top: 0; right: 0; width: 400px; height: 100%; background: #fff; box-shadow: -2px 0 8px rgba(0,0,0,0.2); padding: 20px; overflow-y: auto; z-index: 1000;">
            <button id="closeDrawerBtn" class="btn btn-sm btn-orange mb-3">Close</button>

        <form method="POST" action="{{ route('employee.dashboard.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label fw-bold text-orange">Name*</label>
                    <input type="text" name="name" class="form-control border-orange" value="{{ old('name') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cuisine_type" class="form-label fw-bold text-orange">Cuisine Type*</label>
                    <input type="text" name="cuisine_type" class="form-control border-orange" value="{{ old('cuisine_type') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-bold text-orange">Description</label>
                <textarea name="description" class="form-control border-orange" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="address" class="form-label fw-bold text-orange">Address*</label>
                    <input type="text" name="address" class="form-control border-orange" value="{{ old('address') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label fw-bold text-orange">City*</label>
                    <input type="text" name="city" class="form-control border-orange" value="{{ old('city') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="state" class="form-label fw-bold text-orange">State</label>
                    <input type="text" name="state" class="form-control border-orange" value="{{ old('state') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="postal_code" class="form-label fw-bold text-orange">Postal Code</label>
                    <input type="text" name="postal_code" class="form-control border-orange" value="{{ old('postal_code') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="phone" class="form-label fw-bold text-orange">Phone</label>
                    <input type="text" name="phone" class="form-control border-orange" value="{{ old('phone') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label fw-bold text-orange">Email</label>
                    <input type="email" name="email" class="form-control border-orange" value="{{ old('email') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="website" class="form-label fw-bold text-orange">Website</label>
                    <input type="text" name="website" class="form-control border-orange" value="{{ old('website') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="opening_hours" class="form-label fw-bold text-orange">Opening Hours*</label>
                <input type="text" name="opening_hours" class="form-control border-orange" placeholder="e.g., 9:00 AM - 9:00 PM" value="{{ old('opening_hours') }}" required>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="price_range" class="form-label fw-bold text-orange">Price Range</label>
                    <select name="price_range" class="form-select border-orange">
                        <option value="1" {{ old('price_range') == 1 ? 'selected' : '' }}>$ (Inexpensive)</option>
                        <option value="2" {{ old('price_range') == 2 ? 'selected' : '' }}>$$ (Moderate)</option>
                        <option value="3" {{ old('price_range') == 3 ? 'selected' : '' }}>$$$ (Expensive)</option>
                        <option value="4" {{ old('price_range') == 4 ? 'selected' : '' }}>$$$$ (Very Expensive)</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="image" class="form-label fw-bold text-orange">Image URL</label>
                    <input type="text" name="image" class="form-control border-orange" value="{{ old('image') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold text-orange">Takeout Available</label>
                    <div class="form-check">
                        <input class="form-check-input border-orange" type="radio" name="takeout_available" id="takeout_yes" value="1" {{ old('takeout_available') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="takeout_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input border-orange" type="radio" name="takeout_available" id="takeout_no" value="0" {{ old('takeout_available') == '0' ? 'checked' : '' }} {{ old('takeout_available') === null ? 'checked' : '' }}>
                        <label class="form-check-label" for="takeout_no">No</label>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold text-orange">Reservation Available</label>
                <div class="form-check">
                    <input class="form-check-input border-orange" type="radio" name="reservation_available" id="reservation_yes" value="1" {{ old('reservation_available', '1') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="reservation_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input border-orange" type="radio" name="reservation_available" id="reservation_no" value="0" {{ old('reservation_available') == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="reservation_no">No</label>
                </div>
            </div>

            <button type="submit" class="btn btn-orange">Create Restaurant</button>

        </form>
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

        <script>
            const openDrawerBtn = document.getElementById('openDrawerBtn');
            const closeDrawerBtn = document.getElementById('closeDrawerBtn');
            const drawer = document.getElementById('drawer');

            openDrawerBtn.addEventListener('click', function() {
                drawer.style.display = 'block';
            });

            closeDrawerBtn.addEventListener('click', function() {
                drawer.style.display = 'none';
            });
        </script>

@endsection
