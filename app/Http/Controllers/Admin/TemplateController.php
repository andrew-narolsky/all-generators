<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\BlockContent;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::paginate(10);
        return view('admin.templates._list', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.templates._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
        ]);
        $template = Template::create($request->all());
        session()->flash('success', 'Template was successfully created!');
        return redirect()->route('templates.edit', $template->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = Template::findorfail($id);
        $blocks = Block::all();
        return view('admin.templates._edit', compact('template', 'blocks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
        ]);
        $template = Template::findorfail($id);
        $template->update($request->all());
        session()->flash('success', 'Template was successfully updated!');
        return redirect()->route('templates.edit', $template->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addBlock(Request $request)
    {
        $template = Template::findorfail($request->get('template_id'));
        $template->blocks()->attach($request->get('block_id'));
        $blocks = $template->blocks;
        return view('admin.templates._block_list', compact('blocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteBlock(Request $request)
    {
        $template = Template::findorfail($request->get('template_id'));
        BlockContent::where('block_template_id', $request->get('block_id'))->delete();
        $template->blocks()->newPivotStatement()->where('id', $request->get('block_id'))->delete();
        $blocks = $template->blocks;
        return view('admin.templates._block_list', compact('blocks'));
    }
}
