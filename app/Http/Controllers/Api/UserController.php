<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::with('product', 'ad')->paginate(10);
        return response()->json($users);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&]/']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return response()->json(['message' => 'Login successful', 'user' => Auth::user()]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/'
            ]
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rule' => $request->rule,
        ]);
        Cache::forget('users_list');
        return response()->json(['message' => 'User created successfully', 'user' => $user], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found!'], 404);
        }

        foreach ($user->ad as $ad) {
            $ad->delete();
        }
        foreach ($user->product as $product) {
            foreach ($product->productImage as $image) {
                $imagePath = 'public/' . $image->path;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
                $image->delete();
            }
            $product->delete();
        }

        // Clear user sessions from cache
        $sessions = Cache::get('user_sessions_' . $id, []);
        foreach ($sessions as $sessionId) {
            Session::getHandler()->destroy($sessionId);
        }
        Cache::forget('user_sessions_' . $id);

        // Clear the users cache
        Cache::forget('users_list');

        $user->delete();
        return response()->json(['message' => 'User and associated ads, products, and images deleted successfully!'], 200);
    }

    public function updatePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::find($id); // الحصول على الـ user الحالي

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect.'], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully.'], 200);
    }
}
