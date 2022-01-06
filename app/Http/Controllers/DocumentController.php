<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class DocumentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWordDocumentLink(Request $request)
    {
        $file_name = Str::random(10) . '.' . $request->get('ext');
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText($request->get('text'));
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($file_name);
        $file = new Filesystem();
        $file->moveDirectory(public_path($file_name), public_path('files/' . $file_name));
        return Storage::disk('files')->url($file_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPdfDocumentLink(Request $request)
    {
        $file_name = Str::random(10) . '.pdf';
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($request->get('text'));
        $pdf->save(public_path('files/' . $file_name));
        return Storage::disk('files')->url($file_name);
    }
}
