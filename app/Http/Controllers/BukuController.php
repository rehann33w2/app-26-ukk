<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Buku as Model;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $model = Model::paginate(10);
        $kategoris = Kategori::latest()->get();
        return view('buku.index',[
            'routePrefix' => 'buku',
            'title' => 'Data Buku',
            'model' => $model,
            'kategoris' => $kategoris
        ]);
    }

    public function pinjem(Request $request, $id)
    {
        $model = Model::findOrFail($id);
        return view('peminjam.peminjaman_create', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::get();
        return view('buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul'     => 'required',
            'penulis'   => 'required',
            'penerbit'  => 'required',
            'tahun_terbit' => 'required',
            'deskripsi' => 'required',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stok'       => 'required',
            'id_kategori'     => 'required',
        ]);
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/buku', $gambar->hashName());

        $model = Model::create([
            'gambar'     => $gambar->hashName(),
            'judul'     => $request->get('judul'),
            'penulis'   => $request->get('penulis'),
            'penerbit'  => $request->get('penerbit'),
            'tahun_terbit' => $request->get('tahun_terbit'),
            'deskripsi' => $request->get('deskripsi'),
            'stok'       => $request->get('stok'),
            'id_kategori'     => $request->get('id_kategori'),
        ]);
        return redirect()->route('buku.index', $model);
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
    public function edit($id)
    {
        $buku = Model::findOrFail($id);
        $kategori = Kategori::all();
        return view('buku.update', compact('buku', 'kategori'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Model $buku)
    {
        $this->validate($request, [
            'judul'     => 'required',
            'penulis'   => 'required',
            'penerbit'  => 'required',
            'tahun_terbit' => 'required',
            'deskripsi' => 'required',
            'gambar'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori'  => 'required|array',  
            'stok'       => 'required',
        ]);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //upload new image
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/buku', $gambar->hashName());

            //delete old image
            Storage::delete('public/buku/'.$buku->image);

            //update post with new image
            $buku->update([
                'gambar'     => $gambar->hashName(),
                'judul'     => $request->get('judul'),
                'penulis'   => $request->get('penulis'),
                'penerbit'  => $request->get('penerbit'),
                'tahun_terbit' => $request->get('tahun_terbit'),
                'deskripsi' => $request->get('deskripsi'),
                'stok'       => $request->get('stok'),
            ]);
            $buku->kategori()->sync($request->input('kategori'));

        } else {

            //update post without image
            $buku->update([
                'judul'     => $request->get('judul'),
                'penulis'   => $request->get('penulis'),
                'penerbit'  => $request->get('penerbit'),
                'tahun_terbit' => $request->get('tahun_terbit'),
                'deskripsi' => $request->get('deskripsi'),
                'stok'       => $request->get('stok'),
            ]);
            $buku->kategori()->sync($request->input('kategori'));
        }
        //redirect to index
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Model $buku)
    {
        //delete image
        Storage::delete('public/buku/'. $buku->gambar);

        $buku->kategori()->detach();

        //delete buku
        $buku->delete();

        //redirect to index
        return redirect()->route('buku.index');
    }
}
