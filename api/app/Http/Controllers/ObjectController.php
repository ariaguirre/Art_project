<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ObjectController extends Controller
{
    public function index(Request $request)
    {
            $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects");
            $responseData = $apiResponse->json();
            // print_r($responseData);
            $perPage = $request->input('per_page', 10);
            $objects = array_chunk($responseData['objects'], $perPage);
            $page = $request->input('page', 1);
            return response()->json([
            'data' => $objects[$page - 1] ?? []
            ]);
    }

    public function showId($objectID)
    {
        $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectID}");
        $responseData = $apiResponse->json();
        
        return response()->json($responseData);
    }   

}
