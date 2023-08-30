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
