<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Users
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

            // Delete old image if it exists
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }

            // Build filename and destination
            $image = $request->file('profile_picture');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/profile_images');

            // Ensure the folder exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move file
            $image->move($destinationPath, $filename);

            // Save relative path
            $user->profile_image = 'storage/profile_images/' . $filename;
            $user->save();

            return response()->json(['message' => 'Profile image updated', 'path' => $user->profile_image], 200);




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
