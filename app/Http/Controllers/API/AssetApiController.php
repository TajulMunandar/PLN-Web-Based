<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssetApiController extends Controller
{
    public function getAssets(): JsonResponse
    {
        $assets = Asset::with('fotoAset')->get();

        return response()->json($assets);
    }
}
