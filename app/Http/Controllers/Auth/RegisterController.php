<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Customer;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tenancy\Identification\Events\Switched;

class RegisterController extends Controller
{
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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'subdomain' => 'required|unique:landlord.customers',
            'domain' => 'required|unique:landlord.customers',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function register(Request $request)
    {

        $request->merge(['uuid' => Str::random(15)]);
        $request->merge(['domain' => $request->subdomain . '.' . env('APP_URL')]);

        $this->validator($request->all())->validate();

        event(new Switched($this->createCustomer($request->all())));

        Artisan::call('passport:install');

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect('http://' . $request->input('domain') . $this->redirectTo);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return mixed
     */
    protected function createCustomer(array $data)
    {
        return Customer::create([
            'uuid' => $data['uuid'],
            'subdomain' => $data['subdomain'],
            'domain' => $data['domain']]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
