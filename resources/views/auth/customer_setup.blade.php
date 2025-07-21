<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finish Account Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --orange-50: #fff7ed;
            --orange-100: #ffedd5;
            --orange-200: #fed7aa;
            --orange-300: #fdba74;
            --orange-400: #fb923c;
            --orange-500: #f97316;
            --orange-600: #ea580c;
            --orange-700: #c2410c;
            --orange-800: #9a3412;
            --orange-900: #7c2d12;
        }

        body {
            background-color: var(--orange-50);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
        }

        .setup-container {
            max-width: 500px;
            margin: 2rem auto;
            animation: fadeIn 0.5s ease-out;
        }

        .setup-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-top: 6px solid var(--orange-500);
        }

        .setup-header {
            background: linear-gradient(135deg, var(--orange-400), var(--orange-600));
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .setup-body {
            padding: 2rem;
            background-color: white;
        }

        .form-label {
            font-weight: 600;
            color: var(--orange-700);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            border: 2px solid var(--orange-200);
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--orange-400);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
        }

        .btn-orange {
            background-color: var(--orange-500);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-orange:hover {
            background-color: var(--orange-600);
            transform: translateY(-2px);
        }

        .btn-orange:active {
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--orange-400);
        }

        .input-icon input {
            padding-left: 40px;
        }
    </style>
</head>
<body>
<div class="setup-container">
    <div class="setup-card">
        <div class="setup-header">
            <h2 class="mb-0">
                <i class="bi bi-person-plus me-2"></i>Complete Your Profile
            </h2>
            <p class="form-label">Just a few more details to get started</p>
        </div>

        <div class="setup-body">
            <form method="POST" action="{{ route('customer.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label">First Name</label>
                    <div class="input-icon">
                        <i class="bi bi-person"></i>
                        <input type="text" name="CustomerFName" class="form-control" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Last Name</label>
                    <div class="input-icon">
                        <i class="bi bi-person-fill"></i>
                        <input type="text" name="CustomerLName" class="form-control" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Phone Number</label>
                    <div class="input-icon">
                        <i class="bi bi-telephone"></i>
                        <input type="tel" name="PhoneNo" class="form-control">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Address</label>
                    <div class="input-icon">
                        <i class="bi bi-house"></i>
                        <input type="text" name="Address" class="form-control">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <div class="input-icon">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="Email" class="form-control" value="{{ auth()->user()->email ?? '' }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-orange w-100 mt-3">
                    <i class="bi bi-check-circle-fill me-2"></i>Complete Setup
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
