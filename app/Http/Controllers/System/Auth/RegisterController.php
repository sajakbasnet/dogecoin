<?php

namespace App\Http\Controllers\System\Auth;

use App\Events\UserCreated;
use App\Exceptions\CustomGenericException;
use App\User;
use App\Http\Controllers\Controller;
use App\Model\Role;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect('/' . getSystemPrefix() . '/home');
        } else {
            return view('system.auth.register');
        }
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required|min:8',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {

        $data = $request->except('_token');

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        \DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'google2fa_enabled' => true,
            ]);



            $roleId = Role::where('name', 'user')->pluck('id')->first();

            if ($roleId != null) {
                $user->roles()->attach($roleId);
            } else {
                \DB::rollBack();
                return redirect()->back()->withErrors('User creation failed. Please try again.')->withInput();
            }
             try {
                event(new UserCreated($user));              
            } catch (\Exception $e) {    
                \Log::error('User creation failed: ' . $e->getMessage());
                \DB::rollBack();              
                dd($e); 
                return throw new CustomGenericException('User creation failed. Please try again.');
            }
        });
        return redirect(getSystemPrefix() . '/login')->withErrors(['alert-success' => 'User Registered successfully']);
    }
}
