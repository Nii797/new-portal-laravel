<?php

namespace App\Http\Controllers;

use App\Artikel;
use App\Categori;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Storge;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $artikel = Artikel::latest()->get();
        // return $artikel;
        // die;

        $artikel = Artikel::latest()->get();

        return view('artikel.index', compact('artikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categori = Categori::select('id','nama_kategori')->get();
        return view('artikel.create', compact('categori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'body' => 'required|min:20',
            'gambar' => 'mimes:png,jpg,bmp'
        ]);

        //  default table di table database awalnya null ubah menjadi null
        // $image = $request->file('gambar')->store('artikel');

        // validasi
        if(empty($request->file('gambar'))){
            Artikel::create([
                'judul' => Str::slug($request->judul),
                'body' => $request->body,
                //'gambar' => $image,
                'categoris_id' => $request->categoris_id,
            ]);
        } else {
            Artikel::create([
                'judul' => Str::slug($request->judul),
                'body' => $request->body,
                'gambar' => $request->file('gambar')->store('artikel'),
                'categoris_id' => $request->categoris_id,
            ]);
        }


        // langkah ke satu
        // Artikel::create([
        //     'judul' => Str::slug($request->judul),
        //     'body' => $request->body,
        //     'gambar' => $image,
        //     'categoris_id' => $request->categoris_id,
        // ]);

        return redirect()->route('artikel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categori = Categori::select('id','nama_kategori')->get();
        $artikel = Artikel::find($id);
        return view('artikel.edit', compact('categori','artikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'judul' => 'required',
            'body' => 'required|min:20',
            'gambar' => 'mimes:png,jpg,bmp'
        ]);

        if(empty($request->file('gambar'))){
            $artikel = Artikel::find($id);
            // Storage::delete($artikel->gambar);
            $artikel->update([
                'judul' => Str::slug($request->judul),
                'body' => $request->body,
                // 'gambar' => $request->file('gambar')->store('artikel'),
                'categoris_id' => $request->categoris_id,
            ]);
        } else {
            $artikel = Artikel::find($id);
            Storage::delete($artikel->gambar);
            $artikel->update([
                'judul' => Str::slug($request->judul),
                'body' => $request->body,
                'gambar' => $request->file('gambar')->store('artikel'),
                'categoris_id' => $request->categoris_id,
            ]);
        }

        return redirect()->route('artikel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ========== metode ke 1 tapi salah
        // $artikel = Artikel::find($id);
        // if($artikel->gambar>0){
        //     Storage::delete($artikel->gambar);
        //     $artikel->delete();
        //     return redirect()->route('artikel.index');
        // } else {
        //     $artikel->delete();
        //     return redirect()->route('artikel.index');
        // }

        // ======= Metode ke 2
        // $artikel = Artikel::find($id);
        // if(!$artikel){
        //     return redirect()->back();
        // } else {
        //     Storage::delete($artikel->gambar);
        //     $artikel->delete();
        // }

        // ======= Metode ke 3
        $artikel = Artikel::find($id);

        if(!$artikel){
            return redirect()->back();
        }

        Storage::delete($artikel->gambar);
        $artikel->delete();

        return redirect()->route('artikel.index');
    }
}
