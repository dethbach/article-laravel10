<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = City::get();
        return view('city.index', compact('datas'));
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
        $this->validate($request, [
            'name' => ['required', 'string', 'unique:' . City::class],
        ]);

        $store = City::create([
            'name' => $request->name,
            'url' => $request->url,
        ]);

        if ($store) {
            return back()->with('success', 'Data successfully inserted');
        } else {
            return back()->with('error', 'Error: Data could not be inserted. Please check your input and try again.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posts = Article::where('city_id', $id)->delete();
        $destroyer = City::where('id', $id)->delete();

        if ($destroyer) {
            return back()->with('success', 'Data successfully deleted');
        } else {
            return back()->with('error', 'Error: Data could not be deleted. Please check your input and try again.');
        }
    }
}
