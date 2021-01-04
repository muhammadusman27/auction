<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    // Register User.
    public function registerUser(Request $request) {
        $validated_data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        session(['id' => $user->id, 'user_name' => $user->name ]);
        return redirect()->route('home');
    }

    public function registerPage() {
        return view('user.register');
    }

    public function loginUser(Request $request) {
        $validated_data = $request->validate([
            // check it the user email already exists in user table under email column
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = User::where('email', $request['email'])->first();
            session(['id' => $user->id, 'user_name' => $user->name ]);
            return redirect()->route('home');
        }
        else {
            // If password is not matched, then redirect to login page with password error message.
            return redirect()->route('login_user')->with(['message' => 'Password is not valid.']);
        }
    }


    // public function authenticate(Request $request)
    // {
    //     $validated_data = $request->validate([
    //         // check it the user email already exists in user table under email column
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->route('home');
    //     }
    //     return redirect()->back()->with('myerror','The provided credentials are not valid.');
    // }


    public function loginPage() {
        return view('user.login');
    }

    public function logout(Request $request) {
        // Removing id and user_name value from session for the login user.
        $request->session()->flush();
        return redirect()->route('home');
    }

    public function makePasswordHash() {
        $users = User::all();
        foreach ($users as $user) {
            $user->password = Hash::make($user->password);
            $user->save();
        }
        return 'all password are hashed';
    }


}
