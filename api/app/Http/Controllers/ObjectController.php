<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ObjectController extends Controller
{
    public function show()
    {
        try {
            $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects");
            $responseData = $apiResponse->json();
    
            return response()->json($responseData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en la solicitud a la API externa'], 500);
        }
    }

    public function showId($objectID)
    {
        $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectID}");
        $responseData = $apiResponse->json();
        
        return response()->json($responseData);
    }   

}
