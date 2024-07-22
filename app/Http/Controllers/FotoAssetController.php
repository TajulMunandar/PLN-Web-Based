<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\FotoAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class FotoAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('dashboard.pages.aset.foto_asset.index');
        } catch (Exception $e) {
            Log::error("Error loading photos index: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load the photos page.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implement error handling if needed
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_asset' => 'required|exists:assets,id',
                'foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $assetId = $request->input('id_asset');
            $photos = $request->file('foto');

            foreach ($photos as $photo) {
                $filename = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('storage/foto_asset'), $filename);

                FotoAsset::create([
                    'foto' => $filename,
                    'id_asset' => $assetId,
                ]);
            }

            return redirect()->route('foto_asset.show', ['id' => $assetId])
                ->with('success', 'Photos uploaded successfully.');
        } catch (Exception $e) {
            Log::error("Error uploading photos: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to upload photos.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $asset = Asset::findOrFail($id);
            $photos = FotoAsset::where('id_asset', $id)->get();

            return view('dashboard.pages.aset.foto_asset.index', compact('asset', 'photos'));
        } catch (Exception $e) {
            Log::error("Error displaying photos for asset ID $id: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load photos.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implement error handling if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Implement error handling if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $photo = FotoAsset::findOrFail($id);
            $assetId = $photo->id_asset;

            if (Storage::exists('storage/foto_asset/' . $photo->foto)) {
                Storage::delete('storage/foto_asset/' . $photo->foto);
            }

            $photo->delete();

            return redirect()->route('foto_asset.show', ['id' => $assetId])->with('success', 'Photo deleted successfully.');
        } catch (Exception $e) {
            Log::error("Error deleting photo ID $id: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete photo.');
        }
    }
}
