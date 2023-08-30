<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Painting;

class PaintingController extends Controller
{
    public function get_paintings()
    {
        $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=11");
        $responseData = $apiResponse->json();

        $objectIds = $responseData['objectIDs'] ?? [];
        $limit = 280;
        $count = 0;  
        
        foreach ($objectIds as $objectId) {
            if ($count >= $limit) break; 
            
            $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
            $objectData = $objectResponse->json();

            $artistBeginDate = $objectData['artistBeginDate'];
            $artistEndDate = $objectData['artistEndDate'];
            $objectBeginDate = $objectData['objectBeginDate'];
            $objectEndDate = $objectData['objectEndDate'];

            Painting::create([
                'objectId' => $objectId,
                'title' => $objectData['title'],
                'artistDisplayName' => $objectData['artistDisplayName'],
                'primaryImage' => $objectData['primaryImage'],
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
        $paintings = Painting::all();
        return response()->json($paintings);
    }

    public function getObjectDetails($objectId)
    {
        $painting = Painting::where('objectId', $objectId)->first();

        if ($painting) {
            return response()->json($painting);
        } else {
            return response()->json(['message' => 'Painting not found'], 404);
        }
    }

}
