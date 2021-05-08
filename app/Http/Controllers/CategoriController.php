<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categori;

class CategoriController extends Controller
{
    public function index()
    {
        $categori = Categori::latest()->get();

        return view('categori.index', compact('categori'));
    }

    public function create()
    {
        return view('categori.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nama_kategori' => 'required|min:5',
            'slug' => 'required'
        ]);

        Categori::create($request->all());

        return redirect()->route('categori.index');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $categori = Categori::find($id);
        return view('categori.edit', compact('categori'));
    }

    public function update(Request $request, $id)
    {
        $categori = Categori::find($id);
        $categori->update($request->all());
        return redirect()->route('categori.index');
    }

    public function destroy($id)
    {
        $categori = Categori::find($id);
        if($categori)
        {
            return redirect()->back();
        }
        $categori->delete();
        return redirect()->route('categori.index');
    }
}
