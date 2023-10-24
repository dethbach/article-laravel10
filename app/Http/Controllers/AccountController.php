<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('id', auth()->user()->id)->first();
        return view('account.index', compact('data'));
    }


    public function profpic(Request $request)
    {
        $this->validate($request, [
            'imageUpload' => 'mimes:jpg,png,jpeg'
        ]);

        $newPicName = time() . '-' . $request->imageUpload->getClientOriginalName();
        $request->imageUpload->move(public_path('storage/profile-pic'), $newPicName);

        $update = User::where('id', $request->user_id)->update(['photo' => $newPicName]);

        if ($update) {
            return back()->with('success', 'Profile Updated');
        } else {
            return back()->with('error', 'Failed to update profile');
        }
    }


    public function deleteprofpic()
    {
        $update = User::where('id', auth()->user()->id)->update(['photo' => null]);

        if ($update) {
            return back()->with('success', 'Profile Updated');
        } else {
            return back()->with('error', 'Failed to update profile');
        }
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
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $update = User::where('id', $request->user_id)->update([
            'password' => Hash::make($request->password),
        ]);
        if ($update) {
            return back()->with('success', 'Password Updated');
        } else {
            return back()->with('error', 'Failed to update Password');
        }
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required', 'email',
                Rule::unique('users')->ignore($request->user_id),
            ],
            'username' => [
                'required', 'string', 'min:5', 'max:25', 'alpha_dash:ascii',
                Rule::unique('users')->ignore($request->user_id),
            ]
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $update = User::where('id', $request->user_id)->update([
            'email' => $request->email,
            'username' => $request->username,
            'name' => $request->name,
        ]);

        if ($update) {
            return back()->with('success', 'Data berhasil diupdate');
        } else {
            return back()->with('error', 'Update gagal');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
