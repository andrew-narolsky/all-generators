<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockContent;
use App\Models\Page;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(10);
        return view('admin.pages._list', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Template::all();
        return view('admin.pages._create', compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request->slug);
        $request->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:pages',
        ]);
        $page = Page::create($request->all());
        session()->flash('success', 'Page was successfully created!');
        return redirect()->route('pages.edit', $page->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findorfail($id);
        $templates = Template::all();
        return view('admin.pages._edit', compact('page', 'templates'));
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
        $page = Page::findorfail($id);
        $request['slug'] = Str::slug($request->slug);
        $request->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:pages,slug,' . $page->id,
        ]);
        $page->update($request->all());
        $blocks = [];
        foreach ($request->all('blocks')['blocks'] as $key => $item) {
            $blocks[$key]['block_template_id'] = $key;
            $blocks[$key]['block_id'] = $item['block_id'];
            $blocks[$key]['text'] = serialize($item);
        }
        foreach ($blocks as $block) {
            BlockContent::updateOrCreate(
                ['block_template_id' => $block['block_template_id']],
                $block
            );
        }
        session()->flash('success', 'Page was successfully updated!');
        return redirect()->route('pages.edit', $page->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
