<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\FotoAsset;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::all();
        $categories = Kategori::all(); // Assuming your categories are stored in a Category model
        return view('dashboard.pages.aset.index', compact('assets', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Kategori::all();
        return view('dashboard.pages.aset.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'id_kategori' => 'required',
            'harga' => 'required|numeric',
            'alamat' => 'required|string',
            'kabupaten' => 'required|string',
            'jangka_sewa' => 'required|string',
            'lokasi' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Create asset
        $asset = new Asset();
        $asset->nama = $request->input('nama');
        $asset->id_kategori = $request->input('id_kategori');
        $asset->harga = $request->input('harga');
        $asset->alamat = $request->input('alamat');
        $asset->kabupaten = $request->input('kabupaten');
        $asset->jangka_sewa = $request->input('jangka_sewa');
        $asset->lokasi = $request->input('lokasi');
        $asset->save();

        // Handle image upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads/foto_asset'), $fileName);

                // Save the image reference in foto_assets table
                $fotoAsset = new FotoAsset();
                $fotoAsset->foto = $fileName;
                $fotoAsset->id_asset = $asset->id;
                $fotoAsset->save();
            }
        }

        return redirect()->route('aset.index')->with('success', 'Asset and images added successfully.');
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
    public function edit(Asset $aset)
    {
        $categories = Kategori::all();
        return view('dashboard.pages.aset.edit', compact('aset', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $aset)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'jangka_sewa' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        $aset->update([
            'nama' => $request->input('nama'),
            'id_kategori' => $request->input('kategori'),
            'harga' => $request->input('harga'),
            'alamat' => $request->input('alamat'),
            'kabupaten' => $request->input('kabupaten'),
            'jangka_sewa' => $request->input('jangka_sewa'),
            'lokasi' => $request->input('lokasi'),
        ]);

        return redirect()->route('aset.index')->with('success', 'Asset updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->route('aset.index')->with('success', 'Asset deleted successfully.');
    }
}
