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
        
        // Obtén el valor de "per_page" de la solicitud
        $perPage = $request->input('per_page', 10);

        // Divide los departamentos en páginas según el valor de "per_page"
        $departments = array_chunk($responseData['departments'], $perPage);

        // Obtén la página solicitada de la URL (por defecto, página 1)
        $page = $request->input('page', 1);

        // Devuelve los departamentos de la página solicitada
        return response()->json([
            'data' => $departments[$page - 1] ?? []
        ]);
    }
}
