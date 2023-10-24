<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class AccountManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = User::orderBy('name', 'asc')->get();
        return view('account.account-management', compact('datas'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username)
    {
        $data = User::where('username', $username)->first();
        $users = User::where('username', '!=', $username)->orderBy('name', 'asc')->take(5)->get();
        $posts = Article::where('author_id', $data->id)->take(5)->get();
        return view('account.detail', compact('data', 'users', 'posts'));
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
        $data = User::where('id', $request->userRoleId)->first();

        if ($data->role == 'admin') {
            $update = User::where('id', $request->userRoleId)->update(['role' => 'user']);
            return back();
        } elseif ($data->role == 'user') {
            $update = User::where('id', $request->userRoleId)->update(['role' => 'admin']);
            return back();
        } else {
            return back();
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
