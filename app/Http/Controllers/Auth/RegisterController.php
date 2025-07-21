<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\CustomerSetupController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class RegisterController extends Controller
{
    public function showCustomerRegistrationForm()
    {
        return view('auth.customer_register');
    }

    public function registerCustomer(Request $request)
    {
        return $this->register($request, 'customer');
    }


    public function showEmployeeRegistrationForm()
    {
        return view('auth.employee_register');
    }

    // Process Employee Registration
    public function registerEmployee(Request $request)
    {
        return $this->register($request, 'employee');
    }

    // Shared Registration Logic
    protected function register(Request $request, string $accountType)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];


        if ($accountType === 'employee') {
            $rules['phone'] = ['required', 'string', 'max:11'];
            $rules['position'] = ['required', 'string', 'max:30'];
        }

        $request->validate($rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_type' => $accountType,
        ]);


        if ($accountType === 'employee') {
            \App\Models\Employee::create([
                'EmployeeID' => $user->id,
                'user_id' => $user->id,
                'EmployeeName' => $request->name,
                'EmployeePosition' => $request->position,
                'Phone' => $request->phone,
                'first_time_login' => true,
            ]);
        }

        event(new Registered($user));
        Auth::login($user);

        return $this->redirectAfterRegistration($accountType);
    }

    protected function redirectAfterRegistration(string $accountType)
    {

        if ($accountType === 'customer') {
            if (!auth()->user()->customer) {
                return redirect()->route('customer.setup');
            }

        }

        return redirect()->route('employee.dashboard');
    }


}
