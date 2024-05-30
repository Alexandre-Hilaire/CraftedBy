<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Mindee\Client;
use Mindee\Product\Fr\IdCard\IdCardV2;
use Mindee\Product\Invoice\InvoiceV4;
use Mindee\Input\FileInput;

class MindeeController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env("API_KEY"));
    }
    public function parseFile(Request $request){
        
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,png',
        ]);
        
        $file = $request->file('file');
        $fileStream = fopen($file->getRealPath(), 'r');
        $inputSource = new FileInput($fileStream);
        $apiResponse =  $this->client->parse(IdCardV2::class, $inputSource);
        $documentData = $apiResponse->document;

        fclose($fileStream);

        return response()->json($documentData);
    }
}
