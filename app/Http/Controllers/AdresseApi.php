<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdresseApi extends Controller
{
    public function searchAdress(Request $request){
        $url = 'https://api-adresse.data.gouv.fr/search/?q='.urlencode($request['query']);
        $response = Http::get($url);

        if ($response->successful()){
            return response()->json($response->json());
        }
        else {
            return $response()->json(['error' => 'fetching adress data failed'], 404);
        }
    }
}
