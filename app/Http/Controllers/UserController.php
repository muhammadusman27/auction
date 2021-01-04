<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller
{
    // Register User.
    public function registerUser(Request $request) {
        $validated_data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
        $user = User::create($validated_data);
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
        $email = $request['email'];
        $password =$request['password'];
        $user = DB::table('users')->where('email', $email)->first();
        if ($user->password == $password) {
            session(['id' => $user->id, 'user_name' => $user->name ]);
            return redirect()->route('home');
        }
        else {
            // If password is not matched, then redirect to login page with password error message.
            return redirect()->route('login_user')->with(['message' => 'Password is not valid.']);
        }
    }

    public function loginPage() {
        return view('user.login');
    }

    public function logout(Request $request) {
        // Removing id and user_name value from session for the login user.
        $request->session()->flush();
        return redirect()->route('home');
    }
}
