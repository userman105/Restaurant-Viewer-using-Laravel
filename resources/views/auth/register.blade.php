<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .account-type-card {
            cursor: pointer;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s;
            text-align: center;
            margin-bottom: 15px;
        }
        .account-type-card:hover {
            border-color: #FFA364;
        }
        .account-type-card.active {
            border-color: #E64A19;
            background-color: rgba(13, 110, 253, 0.05);
        }
        .account-type-card i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #FF7B25;
        }
        .account-type-card.active i {
            color: ##FF7B25;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Create Your Account</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/register') }}">
                        @csrf

                        <!-- Name -->
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
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <!-- Account Type Selection -->
                        <div class="mb-4">
                            <label class="form-label d-block mb-3">Account Type <span class="text-danger">*</span></label>

                            <input type="hidden" name="account_type" id="account_type" value="{{ old('account_type') }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="account-type-card {{ old('account_type') == 'employee' ? 'active' : '' }}"
                                         data-account-type="employee">
                                        <i class="bi bi-person-badge"></i>
                                        <h5>Employee</h5>
                                        <p class="text-muted">Register as a staff member</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="account-type-card {{ old('account_type') == 'customer' ? 'active' : '' }}"
                                         data-account-type="customer">
                                        <i class="bi bi-person"></i>
                                        <h5>Customer</h5>
                                        <p class="text-muted">Register as a customer</p>
                                    </div>
                                </div>
                            </div>

                            @error('account_type')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.account-type-card');
        const accountTypeInput = document.getElementById('account_type');

        cards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove active class from all cards
                cards.forEach(c => c.classList.remove('active'));

                // Mark clicked card as active
                this.classList.add('active');


                accountTypeInput.value = this.dataset.accountType;
                console.log('Selected:', accountTypeInput.value); // Debug
            });

            // Initialize selection from old input
            if (card.dataset.accountType === accountTypeInput.value) {
                card.classList.add('active');
            }
        });

        // Validate selection on form submit
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!accountTypeInput.value) {
                e.preventDefault();
                alert('Please select an account type');
            }
        });
    });
</script>
</body>
</html>
