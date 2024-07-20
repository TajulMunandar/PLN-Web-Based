<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch only transactions with 'approve' status of 0 (pending)
        $transaksis = Transaksi::with('asset', 'user')
            ->where('approve', 0)
            ->get();

        // Pass the filtered transactions to the view
        return view('dashboard.pages.transaksi.index', compact('transaksis'));
    }
    public function approve($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->approve = 1; // Set status to approved
        $transaksi->save();

        return redirect()->route('transaksi.index')->with('success', 'Transaction approved successfully.');
    }

    public function decline($id)
    {
        // Find the transaction by ID
        $transaksi = Transaksi::findOrFail($id);

        // Update the approval status
        $transaksi->approve = 2; // Set to declined status
        $transaksi->save();

        // Redirect back with a success message
        return redirect()->route('transaksi.index')->with('success', 'Transaction declined successfully.');
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
        //
    }
}
