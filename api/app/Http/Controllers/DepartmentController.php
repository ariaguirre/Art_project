<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $apiResponse = Http::withoutVerifying()->get('https://collectionapi.metmuseum.org/public/collection/v1/departments');
        $responseData = $apiResponse->json();
        $perPage = $request->input('per_page', 10);
        $departments = array_chunk($responseData['departments'], $perPage);

        $page = $request->input('page', 1);

        return response()->json([
            'data' => $departments[$page - 1] ?? []
        ]);
    }
}
