<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Africa;

class AfricaController extends Controller
{
    public function africa_paintings()
    {
        $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=5");
        $responseData = $apiResponse->json();

        $objectIds = $responseData['objectIDs'] ?? [];
        $limit = 1000;
        $count = 0;  
        
        foreach ($objectIds as $objectId) {
            if ($count >= $limit) break; 
            
            $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
            $objectData = $objectResponse->json();


            $primaryImage = $objectData['primaryImage'];
            $title = $objectData['title'];
            $artistDisplayName = $objectData['artistDisplayName'];

            if (empty($primaryImage) || empty($title)) continue;
            if (empty($artistDisplayName)) 'Unknown';

            $artistBeginDate = isset($objectData['artistBeginDate']) ? intval($objectData['artistBeginDate']) : null;
            $artistEndDate = isset($objectData['artistEndDate']) ? intval($objectData['artistEndDate']) : null;
            $objectBeginDate = isset($objectData['objectBeginDate']) ? intval($objectData['objectBeginDate']) : null;
            $objectEndDate = isset($objectData['objectEndDate']) ? intval($objectData['objectEndDate']) : null;

            Africa::create([
                'objectId' => $objectId,
                'title' => $title,
                'artistDisplayName' => $artistDisplayName,
                'primaryImage' => $primaryImage,
                'department' => $objectData['department'],
                'artistDisplayBio' => $objectData['artistDisplayBio'],
                'artistNationality' => $objectData['artistNationality'],
                'artistBeginDate' => $artistBeginDate,
                'artistEndDate' => $artistEndDate,
                'artistWikidata_URL' => $objectData['artistWikidata_URL'],
                'objectBeginDate' => $objectBeginDate,
                'objectEndDate' => $objectEndDate,
                'dimensions' => $objectData['dimensions'],
                'objectURL' => $objectData['objectURL'],
            ]);
        }
        return response()->json(['message' => 'Data inserted successfully']);
    }
    public function get_all(){
        $paintings = Africa::all();
        return response()->json($paintings);
    }

}
