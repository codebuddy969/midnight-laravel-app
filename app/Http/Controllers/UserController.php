<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Validator};

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('name', 'email')->get();
        
        return response()->json(['data' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = User::create([
                'name' =>  $request->input('name'),
                'email' =>  $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User could not be created'], 500);
        }

        return response()->json(['message' => 'User created successfully', 'data' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' =>  $request->input('name'),
                'email' =>  $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User could not be updated'], 500);
        }

        return response()->json(['message' => 'User updated successfully', 'data' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ids = json_decode($request->ids);

        User::whereIn('id', $ids)->delete();

        return response()->json(['message' => count($ids) > 1 ? 'Users' : 'User' . ' deleted successfully']);
    }
}
