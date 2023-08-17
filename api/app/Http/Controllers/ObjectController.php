<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


class ObjectController extends Controller
{
    public function index()
    {
        $cachedData = Cache::remember('artwork_data', now()->addMinutes(2), function () {
            $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=11");
            $responseData = $apiResponse->json();

            $objectIds = $responseData['objectIDs'] ?? [];
            $limitedObjectIds = array_slice($objectIds, 0, 150);

            $titlesWithArtistsAndImages = [];

            foreach ($limitedObjectIds as $objectId) {
                $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
                $objectData = $objectResponse->json();

                $title = $objectData['title'] ?? 'Título no disponible';
                $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
                $primaryImage = $objectData['primaryImage'] ?? null;

                if ($primaryImage) {
                    $combinedData = [
                        'objectId' => $objectId,
                        'title' => $title,
                        'artistDisplayName' => $artistDisplayName,
                        'primaryImage' => $primaryImage
                    ];

                    if (!in_array($combinedData, $titlesWithArtistsAndImages)) {
                        $titlesWithArtistsAndImages[] = $combinedData;
                    }
                }
            }
            return $titlesWithArtistsAndImages;
        });
        return response()->json($cachedData);
    }

    // MISMA SIN CACHE
    // public function test()
    // {
    //     $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects");
    //     $responseData = $apiResponse->json();
    
    //     $objectIds = $responseData['objectIDs'] ?? [];
    //     $limitedObjectIds = array_slice($objectIds, 0, 200);
    
    //     $titlesWithArtists = [];
    
    //     foreach ($limitedObjectIds as $objectId) {
    //         $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
    //         $objectData = $objectResponse->json();
    
    //         $title = $objectData['title'] ?? 'Título no disponible';
    //         $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
    
    //         $combinedTitle = $title . " - " . $artistDisplayName;
    
    //         if (!in_array($combinedTitle, $titlesWithArtists)) {
    //             $titlesWithArtists[] = $combinedTitle;
    //         }
    //     }
    
    //     return view('objects.index', ['titlesWithArtists' => $titlesWithArtists]);
    // }


    
    public function getObjectDetails($objectId)
    {
        $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
        $objectData = $apiResponse->json(); // Cambiado a $objectData
    
        $title = $objectData['title'] ?? 'Título no disponible';
        $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
        $primaryImage = $objectData['primaryImage'] ?? null;
    
        return response()->json([
            'objectId' => $objectId,
            'title' => $title,
            'artistDisplayName' => $artistDisplayName,
            'primaryImage' => $primaryImage
        ]);
    }
    public function showId($objectID)
    {
        $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectID}");
        $responseData = $apiResponse->json();
        
        return response()->json($responseData);
    }   

}
