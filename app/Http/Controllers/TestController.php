<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testRegistration(Request $request)
    {
        $user = User::create([
            'name' => 'HARDCODED_TEST',
            'email' => 'test_'.time().'@example.com',
            'password' => bcrypt('password'),
            'account_type' => 'delivery_worker' // Force value
        ]);

        dd($user->fresh(), DB::table('users')->find($user->id));
    }
}
