<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EssayMaker;

class EssayMakerController extends Controller
{
    protected mixed $essayMaker;

    public function __construct(EssayMaker $essayMaker)
    {
        $this->essayMaker = $essayMaker;
    }

    public function index()
    {
        $essayMakers = $this->essayMaker->orderByDesc('created_at')->paginate(10);
        return view('admin.essay_maker._list', compact('essayMakers'));
    }

    public function show($id)
    {
        $essayMakers = $this->essayMaker->findOrFail($id);
        return view('admin.essay_maker.show', compact('essayMakers'));
    }
}
