<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RiwayatUserApiController extends Controller
{
    public function showRiwayatUser(Request $request): JsonResponse
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Fetch transactions for the authenticated user
        $transaksis = Transaksi::where('id_user', $userId)
            ->with('asset') // Eager load the asset relationship
            ->get();

        if ($transaksis->isEmpty()) {
            return response()->json(['message' => 'No transactions found'], 404);
        }

        // Format the response
        $transactions = $transaksis->map(function ($transaksi) {
            return [
                'tanggal' => $transaksi->start->format('Y-m-d H:i:s'),
                'nama_asset' => $transaksi->asset->nama,
                'harga' => $transaksi->asset->harga,
                'status_approve' => $transaksi->approve ? 'Approved' : 'Pending',
            ];
        });

        return response()->json(['transaksi' => $transactions], 200);
    }
}
