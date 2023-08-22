<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Artwork;

class ArtworkController extends Controller
{
    public function get_objects()
    {
        $apiResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects?departmentIds=11");
        $responseData = $apiResponse->json();

        $objectIds = $responseData['objectIDs'] ?? [];

        foreach ($objectIds as $objectId) {
            $objectResponse = Http::withoutVerifying()->get("https://collectionapi.metmuseum.org/public/collection/v1/objects/{$objectId}");
            $objectData = $objectResponse->json();

            // Validar y corregir valores numéricos
            $artistBeginDate = is_numeric($objectData['artistBeginDate']) ? (int) $objectData['artistBeginDate'] : 0; // Otra opción en lugar de 0 podría ser -1
            $artistEndDate = is_numeric($objectData['artistEndDate']) ? (int) $objectData['artistEndDate'] : 0; // Otra opción en lugar de 0 podría ser -1
            $objectBeginDate = is_numeric($objectData['objectBeginDate']) ? (int) $objectData['objectBeginDate'] : 0; // Otra opción en lugar de 0 podría ser -1
            $objectEndDate = is_numeric($objectData['objectEndDate']) ? (int) $objectData['objectEndDate'] : 0; // Otra opción en lugar de 0 podría ser -1


            Artwork::create([
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
}


