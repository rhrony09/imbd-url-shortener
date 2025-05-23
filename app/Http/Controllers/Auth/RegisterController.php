<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20|unique:users,mobile',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data) {
        $username = explode('@', $data['email'])[0];
        $username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
        if (User::where('username', $username)->exists()) {
            $i = 1;
            while (User::where('username', $username . $i)->exists()) {
                $i++;
            }
            $username .= $i;
        }
        return User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'role_id' => 3,
            'username' => $username,
            'password' => Hash::make($data['password']),
        ]);
    }
}
