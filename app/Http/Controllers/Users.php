<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Users extends Controller
{
    //

    public function authenticate(Request $request): RedirectResponse
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function createAccount(Request $request)
    {

        $request->validate([
            'user_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new User(); // or just User if already imported
        $user->name = $request->input('user_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user, $request->filled('remember')); // Log the user in after registration

        return redirect()->intended('dashboard');


    }


    public function userProfile($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            return view('user_details', compact('user'));
        }
    }

    function update_profile_picture(Request $request)
    {
        $request->validate(['profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);

        try {
            $user = Auth::user();
            if ($user->profile_image) {
                Storage::delete('public' . $user->profile_image);
            }

            $path = $request->file('profile_picture')->store('profile_images', 'public');

            $user->profile_image = $path;
            $user->save();


        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }

        return response()->json([
            'success' => true,
            'path' => asset('storage/' . $path)
        ]);
    }


    function update_profile_details(Request $request)
    {

//        echo "Hello";
//        die;

//       dd($request);
        $request->validate([

            'bio' => 'nullable|string|min:6',
            'full_name' => 'nullable|string|max:50|unique:users,full_name',
        ]);

//        echo "HELLO ";
//        die;


        Auth::user()->update($request->only([ 'bio','full_name']));




//        return response()->json([])

        return back()->with('success', 'Profile updated successfully!');



    }
}
