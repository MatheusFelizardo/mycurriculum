<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PdfController extends Controller
{
   
    /**
     * Display the user's profile form.
     */

    public function read(Request $request): Response
    {
        $file = $request->file('cv');
        $destinationPath = public_path('pdfs');
        $fileName = $file->getClientOriginalName(); 
        $file->move($destinationPath, $fileName);
        
        $pdfPath = public_path("pdfs/$fileName");
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($pdfPath);
        $text = $pdf->getText();
        $gpt = new ChatGPTController();
        $gptResponse = $gpt->sendChatGTPText($text);

        unlink($pdfPath);

        return Inertia::render('Pdf/Read', [
            'data' =>$text,
            'gptResponse' => $gptResponse
        ]);
    }

    public function update(Request $request): Response
    {
        $gpt = new ChatGPTController();
        $gptResponse = $gpt->improveCVWithChatGPT($request->description, $request->cv);

        return Inertia::render('Pdf/Update', [
            'data' =>$gptResponse,
        ]);
        
    }
}
