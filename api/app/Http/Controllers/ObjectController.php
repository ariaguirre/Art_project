<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


class ObjectController extends Controller
{
    public function get_objects()
    {
        $artworksFromDB = Artwork::all();
        if (!$artworksFromDB->isEmpty()) {
            return response()->json($artworksFromDB);
        }

        $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=11");
        $responseData = $apiResponse->json();

        $objectIds = $responseData['objectIDs'] ?? [];
        $limitedObjectIds = array_slice($objectIds, 0, 150);

        $artworksToStore = [];

        foreach ($limitedObjectIds as $objectId) {
            $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
            $objectData = $objectResponse->json();

            $artistDisplayName = $objectData['artistDisplayName'] ?? null;
            $primaryImage = $objectData['primaryImage'] ?? null;
            $department = $objectData['department'] ?? null;
            $artistDisplayBio = $objectData['artistDisplayBio'] ?? null;
            $artistNationality = $objectData['artistNationality'] ?? null;
            $artistBeginDate = $objectData['artistBeginDate'] ?? null;
            $artistEndDate = $objectData['artistEndDate'] ?? null;
            $artistWikidata_URL = $objectData['artistWikidata_URL'] ?? null;
            $objectBeginDate = $objectData['objectBeginDate'] ?? null;
            $objectEndDate = $objectData['objectEndDate'] ?? null;
            $dimensions = $objectData['dimensions'] ?? null;
            $objectURL = $objectData['objectURL'] ?? null;

            if ($primaryImage) {
                $combinedData = [
                    'objectId' => $objectId,
                    'artistDisplayName' => $artistDisplayName,
                    'primaryImage' => $primaryImage,
                    'department' => $department,
                    'artistDisplayBio' => $artistDisplayBio,
                    'artistNationality' => $artistNationality,
                    'artistBeginDate' => $artistBeginDate,
                    'artistEndDate' => $artistEndDate,
                    'artistWikidata_URL' => $artistWikidata_URL,
                    'objectBeginDate' => $objectBeginDate,
                    'objectEndDate' => $objectEndDate,
                    'dimensions' => $dimensions,
                    'objectURL' => $objectURL
                ];

                $artworksToStore[] = $combinedData;
            }
        }

        foreach ($artworksToStore as $data) {
            Artwork::create($data);
        }

        return response()->json($artworksToStore);
    }
}













//     public function index()
//     {
//         $cachedData = Cache::remember('artwork_data', now()->addHours(1), function () {
//             $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=11");
//             $responseData = $apiResponse->json();

//             $objectIds = $responseData['objectIDs'] ?? [];
//             $limitedObjectIds = array_slice($objectIds, 0, 150);

//             $titlesWithArtistsAndImages = [];

//             foreach ($limitedObjectIds as $objectId) {
//                 $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
//                 $objectData = $objectResponse->json();

//                 $title = $objectData['title'] ?? 'Título no disponible';
//                 $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
//                 $primaryImage = $objectData['primaryImage'] ?? null;

//                 if ($primaryImage) {
//                     $combinedData = [
//                         'objectId' => $objectId,
//                         'title' => $title,
//                         'artistDisplayName' => $artistDisplayName,
//                         'primaryImage' => $primaryImage
//                     ];

//                     if (!in_array($combinedData, $titlesWithArtistsAndImages)) {
//                         $titlesWithArtistsAndImages[] = $combinedData;
//                     }
//                 }
//             }
//             return $titlesWithArtistsAndImages;
//         });
//         return response()->json($cachedData);
//     }

//     public function africa()
//     {
//         $cachedData = Cache::remember('africa_data', now()->addHours(1), function () {
//             $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=5");
//             $responseData = $apiResponse->json();

//             $objectIds = $responseData['objectIDs'] ?? [];
//             $limitedObjectIds = array_slice($objectIds, 0, 150);

//             $titlesWithArtistsAndImages = [];

//             foreach ($limitedObjectIds as $objectId) {
//                 $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
//                 $objectData = $objectResponse->json();

//                 $title = $objectData['title'] ?? 'Título no disponible';
//                 $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
//                 $primaryImage = $objectData['primaryImage'] ?? null;

//                 if ($primaryImage) {
//                     $combinedData = [
//                         'objectId' => $objectId,
//                         'title' => $title,
//                         'artistDisplayName' => $artistDisplayName,
//                         'primaryImage' => $primaryImage
//                     ];

//                     if (!in_array($combinedData, $titlesWithArtistsAndImages)) {
//                         $titlesWithArtistsAndImages[] = $combinedData;
//                     }
//                 }
//             }
//             return $titlesWithArtistsAndImages;
//         });
//         return response()->json($cachedData);
//     }

//     public function asia()
//     {
//         $cachedData = Cache::remember('asia_data', now()->addHours(1), function () {
//             $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=6");
//             $responseData = $apiResponse->json();

//             $objectIds = $responseData['objectIDs'] ?? [];
//             $limitedObjectIds = array_slice($objectIds, 0, 150);

//             $titlesWithArtistsAndImages = [];

//             foreach ($limitedObjectIds as $objectId) {
//                 $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
//                 $objectData = $objectResponse->json();

//                 $title = $objectData['title'] ?? 'Título no disponible';
//                 $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
//                 $primaryImage = $objectData['primaryImage'] ?? null;

//                 if ($primaryImage) {
//                     $combinedData = [
//                         'objectId' => $objectId,
//                         'title' => $title,
//                         'artistDisplayName' => $artistDisplayName,
//                         'primaryImage' => $primaryImage
//                     ];

//                     if (!in_array($combinedData, $titlesWithArtistsAndImages)) {
//                         $titlesWithArtistsAndImages[] = $combinedData;
//                     }
//                 }
//             }
//             return $titlesWithArtistsAndImages;
//         });
//         return response()->json($cachedData);
//     }
    
//     public function egypt()
//     {
//         $cachedData = Cache::remember('egypt_data', now()->addHours(1), function () {
//             $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=10");
//             $responseData = $apiResponse->json();

//             $objectIds = $responseData['objectIDs'] ?? [];
//             $limitedObjectIds = array_slice($objectIds, 0, 150);

//             $titlesWithArtistsAndImages = [];

//             foreach ($limitedObjectIds as $objectId) {
//                 $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
//                 $objectData = $objectResponse->json();

//                 $title = $objectData['title'] ?? 'Título no disponible';
//                 $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
//                 $primaryImage = $objectData['primaryImage'] ?? null;

//                 if ($primaryImage) {
//                     $combinedData = [
//                         'objectId' => $objectId,
//                         'title' => $title,
//                         'artistDisplayName' => $artistDisplayName,
//                         'primaryImage' => $primaryImage
//                     ];

//                     if (!in_array($combinedData, $titlesWithArtistsAndImages)) {
//                         $titlesWithArtistsAndImages[] = $combinedData;
//                     }
//                 }
//             }
//             return $titlesWithArtistsAndImages;
//         });
//         return response()->json($cachedData);
//     }

//     public function greek()
//     {
//         $cachedData = Cache::remember('greek_data', now()->addHours(1), function () {
//             $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=13");
//             $responseData = $apiResponse->json();

//             $objectIds = $responseData['objectIDs'] ?? [];
//             $limitedObjectIds = array_slice($objectIds, 0, 150);

//             $titlesWithArtistsAndImages = [];

//             foreach ($limitedObjectIds as $objectId) {
//                 $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
//                 $objectData = $objectResponse->json();

//                 $title = $objectData['title'] ?? 'Título no disponible';
//                 $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
//                 $primaryImage = $objectData['primaryImage'] ?? null;

//                 if ($primaryImage) {
//                     $combinedData = [
//                         'objectId' => $objectId,
//                         'title' => $title,
//                         'artistDisplayName' => $artistDisplayName,
//                         'primaryImage' => $primaryImage
//                     ];

//                     if (!in_array($combinedData, $titlesWithArtistsAndImages)) {
//                         $titlesWithArtistsAndImages[] = $combinedData;
//                     }
//                 }
//             }
//             return $titlesWithArtistsAndImages;
//         });
//         return response()->json($cachedData);
//     }

//     public function islamic()
//     {
//         $cachedData = Cache::remember('islamic_data', now()->addHours(1), function () {
//             $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=14");
//             $responseData = $apiResponse->json();

//             $objectIds = $responseData['objectIDs'] ?? [];
//             $limitedObjectIds = array_slice($objectIds, 0, 150);

//             $titlesWithArtistsAndImages = [];

//             foreach ($limitedObjectIds as $objectId) {
//                 $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
//                 $objectData = $objectResponse->json();

//                 $title = $objectData['title'] ?? 'Título no disponible';
//                 $artistDisplayName = $objectData['artistDisplayName'] ?? 'Artista desconocido';
//                 $primaryImage = $objectData['primaryImage'] ?? null;

//                 if ($primaryImage) {
//                     $combinedData = [
//                         'objectId' => $objectId,
//                         'title' => $title,
//                         'artistDisplayName' => $artistDisplayName,
//                         'primaryImage' => $primaryImage
//                     ];

//                     if (!in_array($combinedData, $titlesWithArtistsAndImages)) {
//                         $titlesWithArtistsAndImages[] = $combinedData;
//                     }
//                 }
//             }
//             return $titlesWithArtistsAndImages;
//         });
//         return response()->json($cachedData);
//     }

    
//     public function getObjectDetails($objectId)
//     {
//         $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
//         $objectData = $apiResponse->json(); 
    
//         $title = $objectData['title'] ?? 'No title available';
//         $artistDisplayName = $objectData['artistDisplayName'] ?? 'Unknown artist';
//         $primaryImage = $objectData['primaryImage'] ?? null;
//         $department = $objectData['department'] ?? null;
//         $artistDisplayBio = $objectData['artistDisplayBio'] ?? 'No bio available';
//         $artistNationality = $objectData['artistNationality'] ?? null;
//         $artistBeginDate = $objectData['artistBeginDate'] ?? null;
//         $artistEndDate = $objectData['artistEndDate'] ?? null;
//         $artistWikidata_URL = $objectData['artistWikidata_URL'] ?? 'No URL available.';
//         $objectBeginDate = $objectData['objectBeginDate'] ?? null;
//         $objectEndDate = $objectData['objectEndDate'] ?? null;
//         $dimensions = $objectData['dimensions'] ?? null;
//         $objectURL = $objectData['objectURL'] ?? 'No URL available';
    
//         return response()->json([
//             'objectId' => $objectId,
//             'title' => $title,
//             'artistDisplayName' => $artistDisplayName,
//             'primaryImage' => $primaryImage,
//             'department' => $department,
//             'artistDisplayBio' => $artistDisplayBio,
//             'artistNationality'=> $artistNationality,
//             'artistBeginDate' =>$artistBeginDate,
//             'artistEndDate' => $artistEndDate,
//             'artistWikidata_URL' => $artistWikidata_URL,
//             'objectBeginDate' => $objectBeginDate,
//             'objectEndDate' => $objectEndDate,
//             'dimensions' => $dimensions,
//             'objectURL' => $objectURL,
//         ]);
//     }
//     public function showId($objectID)
//     {
//         $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectID}");
//         $responseData = $apiResponse->json();
        
//         return response()->json($responseData);
//     }   

// }
