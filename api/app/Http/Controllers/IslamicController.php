<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Islamic;

class IslamicController extends Controller
{
    public function islamic_paintings()
    {
        $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=14");
        $responseData = $apiResponse->json();

        $objectIds = $responseData['objectIDs'] ?? [];
        $limit = 2000;
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

            Islamic::updateOrCreate([
                'objectId' => $objectId,
                'title' => $title,
                'artistDisplayName' => $artistDisplayName,
                'primaryImage' => $primaryImage,
                'department' => $objectData['department'],
                'artistDisplayBio' => $objectData['artistDisplayBio'],
                'isHighlight' => $objectData['isHighlight'],
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
        $paintings = Islamic::all();
        return response()->json($paintings);
    }
    public function searchPaintings(Request $request)
    {
        $term = $request->input('term');

        $results = Islamic::where('title', 'LIKE', "%$term%")
            ->orWhere('artistDisplayName', 'LIKE', "%$term%")
            ->get();

        return response()->json($results);
    }

}
