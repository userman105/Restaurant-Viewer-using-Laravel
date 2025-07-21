<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .orange-theme {
            --orange-primary: #FF7B25;
            --orange-light: #FFA364;
            --orange-dark: #E64A19;
            --orange-bg-light: #FFF3E0;
            --orange-text: #5D4037;
        }

        body.orange-theme {
            background-color: var(--orange-bg-light);
            color: var(--orange-text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .orange-theme .auth-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(255, 123, 37, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .orange-theme .auth-header {
            background: linear-gradient(135deg, var(--orange-primary), var(--orange-dark));
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .orange-theme .auth-body {
            padding: 2rem;
            background-color: white;
        }

        .orange-theme .btn-orange {
            background-color: var(--orange-primary);
            border-color: var(--orange-primary);
            color: white;
            font-weight: 600;
            padding: 10px 24px;
            transition: all 0.3s;
        }

        .orange-theme .btn-orange:hover {
            background-color: var(--orange-dark);
            border-color: var(--orange-dark);
            transform: translateY(-2px);
        }

        .orange-theme .form-control:focus {
            border-color: var(--orange-light);
            box-shadow: 0 0 0 0.25rem rgba(255, 123, 37, 0.25);
        }

        .orange-theme .invalid-feedback {
            color: var(--orange-dark);
        }

        .orange-theme .auth-footer {
            text-align: center;
            padding: 1rem;
            background-color: rgba(255, 163, 100, 0.1);
            font-size: 0.9rem;
        }

        .orange-theme .auth-footer a {
            color: var(--orange-dark);
            text-decoration: none;
            font-weight: 600;
        }

        .orange-theme .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .orange-theme .form-check-input:checked {
            background-color: var(--orange-primary);
            border-color: var(--orange-primary);
        }
    </style>
</head>
<body class="orange-theme">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="auth-card">
                <div class="auth-header">
                    <h2><i class="bi bi-box-arrow-in-right"></i> Welcome Back</h2>
                    <p class="mb-0">Sign in to your account</p>
                </div>

                <div class="auth-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required
                                   placeholder="Enter your email" autofocus>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required
                                   placeholder="Enter your password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="remember-forgot">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <div>
                                @if(Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Forgot password?</a>
                                @endif
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-orange btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </button>
                        </div>
                    </form>
                </div>

                <div class="auth-footer">
                    Don't have an account? <a href="/register/customer">Register here</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
