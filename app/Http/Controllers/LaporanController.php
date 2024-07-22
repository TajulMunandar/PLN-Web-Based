<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Fetch transactions with 'approve' value of 1 or 2, excluding 0
            $transaksis = Transaksi::with(['asset', 'user'])
                ->whereIn('approve', [1, 2])
                ->get();

            return view('dashboard.pages.laporan.index', compact('transaksis'));
        } catch (Exception $e) {
            Log::error("Error fetching transactions: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load transactions.');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['asset', 'user'])->findOrFail($id);
        return view('dashboard.pages.laporan.index', compact('transaksi'));
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
        //
    }
}
