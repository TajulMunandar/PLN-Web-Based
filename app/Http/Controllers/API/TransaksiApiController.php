<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransaksiApiController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'id_asset' => 'required|exists:assets,id',
            'id_user' => 'required|exists:users,id',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'approve' => 'required|boolean',
            'ket' => 'nullable|string',
            'total_harga' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Handle the file upload
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('uploads/bukti', $filename, 'public');

                // Store only the filename in the database
                $filePath = $filename;
            } else {
                return response()->json(['error' => 'No file uploaded.'], 400);
            }

            // Debug: Check if file was stored
            if (Storage::disk('public')->exists('uploads/bukti/' . $filePath)) {
                Log::info('File stored successfully at ' . $filePath); // Log success
            } else {
                Log::error('Failed to store file at ' . $filePath); // Log failure
                return response()->json(['error' => 'Failed to store file'], 500);
            }

            // Create a new transaksi record
            $transaksi = Transaksi::create([
                'id_asset' => $request->input('id_asset'),
                'id_user' => $request->input('id_user'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
                'bukti' => $filePath,  // Store the file path
                'approve' => $request->input('approve'),
                'ket' => $request->input('ket'),
                'total_harga' => $request->input('total_harga'),
            ]);

            return response()->json($transaksi, 201);
        } catch (\Exception $e) {
            Log::error('Error storing transaksi: ' . $e->getMessage()); // Log the exception
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
