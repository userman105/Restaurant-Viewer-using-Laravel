<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFF3E0;
        }
        .registration-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .employee-header {
            background-color:  #E64A19;
            color: #FFF3E0;
        }

        .btn-secondary{
            color: #FF7B25;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card registration-card">
                <div class="card-header employee-header py-3">
                    <h4 class="mb-0 text-center">Employee Registration</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.employee') }}">
                        @csrf

                        <!-- Account Type (Hidden) -->
                        <input type="hidden" name="account_type" value="customer">

                        <!-- Full Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ old('phone') }}" required maxlength="11">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input id="position" type="text" class="form-control @error('position') is-invalid @enderror"
                                   name="position" value="{{ old('position') }}" required maxlength="10">
                            @error('position')
                            <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
                            @enderror
                        </div>


                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="text-center mt-4">
                            <p>Are you a customer? <a href="{{ route('register.customer') }}" class="btn btn-outline-success">Register as Customer</a></p>
                        </div>

                        <a href="{{ route('login') }}" class="btn-secondary">
                            Already have an account? Login
                        </a>

                        <div class="d-grid">
                            <button type="submit" class="btn-secondary">
                                Register as Employee
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
