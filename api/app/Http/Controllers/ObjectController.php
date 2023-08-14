<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


class ObjectController extends Controller
{
    // public function index(Request $request)
    // {
    //     $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects");
    //     $responseData = $apiResponse->json();

    //     // Extract and return the first 100 object IDs
    //     $objectIds = $responseData['objectIDs'] ?? [];
    //     $limitedObjectIds = array_slice($objectIds, 0, 100);
    //     // var_dump($limitedObjectIds);

    //     return response()->json([
    //         'data' => $limitedObjectIds
    //     ]);
    // }

    // public function test()
    // {
    //     $cachedData = Cache::remember('artwork_data', now()->addHours(1), function () {
    //         $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects");
    //         $responseData = $apiResponse->json();
    
    //         $objectIds = $responseData['objectIDs'] ?? [];
    //         $limitedObjectIds = array_slice($objectIds, 0, 200);
    
    //         $titlesWithArtists = [];
    
    //         foreach ($limitedObjectIds as $objectId) {
    //             $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
    //             $objectData = $objectResponse->json();
    
    //             $title = $objectData['title'] ?? 'Título no disponible';
    //             $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
    
    //             $combinedTitle = $title . " - " . $artistDisplayName;
    
    //             if (!in_array($combinedTitle, $titlesWithArtists)) {
    //                 $titlesWithArtists[] = $combinedTitle;
    //             }
    //         }
    
    //         return $titlesWithArtists;
    //     });
    
    //     return view('objects.index', ['titlesWithArtists' => $cachedData]);
    // }

    // MISMA SIN CACHE
    public function test()
    {
        $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects");
        $responseData = $apiResponse->json();
    
        $objectIds = $responseData['objectIDs'] ?? [];
        $limitedObjectIds = array_slice($objectIds, 0, 200);
    
        $titlesWithArtists = [];
    
        foreach ($limitedObjectIds as $objectId) {
            $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
            $objectData = $objectResponse->json();
    
            $title = $objectData['title'] ?? 'Título no disponible';
            $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
    
            $combinedTitle = $title . " - " . $artistDisplayName;
    
            if (!in_array($combinedTitle, $titlesWithArtists)) {
                $titlesWithArtists[] = $combinedTitle;
            }
        }
    
        return view('objects.index', ['titlesWithArtists' => $titlesWithArtists]);
    }


    
    // public function getObjectDetails($objectId)
    // {
    //     $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
    //     $responseData = $apiResponse->json();

    //     $data = $responseData['title'] ?? 'Título no disponible';

    //     // Puedes acceder a otros campos de la obra de manera similar

    //     return response()->json([
    //         'objectId' => $objectId,
    //         'title' => $title,
    //         // Agrega otros campos según tus necesidades
    //     ]);
    // }
    // public function showId($objectID)
    // {
    //     $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectID}");
    //     $responseData = $apiResponse->json();
        
    //     return response()->json($responseData);
    // }   

}
