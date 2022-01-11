<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParaphrasingTool;

class ParaphrasingToolController extends Controller
{
    public function index()
    {
        $paraphrasings = ParaphrasingTool::orderByDesc('created_at')->paginate(10);
        return view('admin.paraphrasing_tool._list', compact('paraphrasings'));
    }

    public function show($id)
    {
        $paraphrasing = ParaphrasingTool::findOrFail($id);
        return view('admin.paraphrasing_tool.show', compact('paraphrasing'));
    }
}
