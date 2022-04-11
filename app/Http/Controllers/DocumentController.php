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
    public mixed $str;
    public mixed $filesystem;
    public mixed $storage;
    public mixed $app;

    public function __construct(Str $str, Filesystem $filesystem, Storage $storage, App $app)
    {
        $this->str = $str;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
        $this->app = $app;
    }

    public function getWordDocumentLink(Request $request) : string
    {
        $file_name = $this->str::random(10) . '.' . $request->get('ext');
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText($request->get('text'));
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($file_name);
        $this->filesystem->moveDirectory(public_path($file_name), public_path('files/' . $file_name));
        return $this->storage::disk('files')->url($file_name);
    }

    public function getPdfDocumentLink(Request $request) : string
    {
        $file_name = $this->str::random(10) . '.pdf';
        $pdf = $this->app::make('dompdf.wrapper');
        $pdf->loadHTML($request->get('text'));
        $pdf->save(public_path('files/' . $file_name));
        return $this->storage::disk('files')->url($file_name);
    }
}
