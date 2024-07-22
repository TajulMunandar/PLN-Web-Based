<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $katagoris = Kategori::all();
            return view('dashboard.pages.kategori.index', compact('katagoris'));
        } catch (Exception $e) {
            Log::error("Error fetching categories: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load categories.');
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
            // Validate the incoming request
            $validated = $request->validate([
                'kategori' => 'required|string|max:255'
            ]);

            // Create a new category
            Kategori::create([
                'kategori' => $validated['kategori']
            ]);

            // Redirect with success message
            return redirect()->route('kategori.index')->with('success', 'Category successfully created.');
        } catch (Exception $e) {
            Log::error("Error creating category: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implement error handling if needed
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
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'kategori' => 'required|string|max:255',
            ]);

            $kategori = Kategori::findOrFail($id);
            $kategori->kategori = $request->input('kategori');
            $kategori->save();

            return redirect()->route('kategori.index')->with('success', 'Category updated successfully.');
        } catch (Exception $e) {
            Log::error("Error updating category ID $id: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();
            return redirect()->route('kategori.index')->with('success', 'Category deleted successfully.');
        } catch (Exception $e) {
            Log::error("Error deleting category ID $id: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete category.');
        }
    }
}
