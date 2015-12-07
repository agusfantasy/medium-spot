<?php
namespace MediumSpot\Http\Controllers\Front;

use MediumSpot\User;
use MediumSpot\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('front.auth_login');
    }

    public function postlogin()
    {
        $user = new User;

        $email = trim(\Input::get('email'));
        $password = sha1(\Input::get('password'));

        $user = $user->findBy($email, $password);

        if (!$user) {
            return redirect('/auth/login')->with('error', "Sorry, It doesn't recognize that email.");
        }

        session(['user' => $user]);   

        return redirect('/');
    }

    public function register()
    {
        return view('front.auth_register');
    }

    protected function validate(array $data)
    {
        return \Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    function postRegister()
    {
        $data = \Input::all();

        $validate = $this->validate($data);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $data['password'] = sha1($data['password']);

        $user = new User;

        $create = $user->create($data);

        if (!$create) {
            return redirect('/register')->with('errors', "Sorry, It doesn't recognize that email.");
        }

        return redirect('/auth/login');   
    }
}
