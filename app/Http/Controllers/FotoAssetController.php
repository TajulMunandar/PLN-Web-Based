<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\FotoAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pages.aset.foto_asset.index');
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
            'id_asset' => 'required|exists:assets,id',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $assetId = $request->input('id_asset');
        $photos = $request->file('foto');

        foreach ($photos as $photo) {
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('uploads/foto_asset'), $filename);

            FotoAsset::create([
                'foto' => $filename,
                'id_asset' => $assetId,
            ]);
        }

        return redirect()->route('foto_asset.show', ['id' => $assetId])
            ->with('success', 'Photos uploaded successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asset = Asset::findOrFail($id);
        $photos = FotoAsset::where('id_asset', $id)->get();

        return view('dashboard.pages.aset.foto_asset.index', compact('asset', 'photos'));
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
        $photo = FotoAsset::findOrFail($id);
        $assetId = $photo->id_asset;

        if (Storage::exists('uploads/foto_asset/' . $photo->foto)) {
            Storage::delete('uploads/foto_asset/' . $photo->foto);
        }

        $photo->delete();

        // Redirect back with a success message
        return redirect()->route('foto_asset.show', ['id' => $assetId])->with('success', 'Photo deleted successfully.');
    }
}
