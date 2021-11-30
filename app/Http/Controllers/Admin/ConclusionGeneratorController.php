<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConclusionGenerator;

class ConclusionGeneratorController extends Controller
{
    public function index()
    {
        $conclusions = ConclusionGenerator::orderByDesc('created_at')->paginate(10);
        return view('admin.conclusion_generator._list', compact('conclusions'));
    }

    public function show($id)
    {
        $conclusion = ConclusionGenerator::findOrFail($id);
        return view('admin.conclusion_generator.show', compact('conclusion'));
    }
}
