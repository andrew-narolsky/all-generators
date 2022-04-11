<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiKeysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.api_keys.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->envUpdate('PARAPHRASING_API_URL', $request->paraphrasing_url);
        $this->envUpdate('PARAPHRASING_API_KEY', $request->paraphrasing_key);
        $this->envUpdate('ESSAY_MAKER_API_URL', $request->essay_maker_url);
        $this->envUpdate('ESSAY_MAKER_API_KEY', $request->essay_maker_key);
        session()->flash('success', 'Settings was updated!');
        return redirect()->route('api-keys.index');
    }

    /**
     * Update Laravel Env file Key's Value
     * @param string $key
     * @param string $value
     */
    public static function envUpdate($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . str_replace(' ', '_', $value), file_get_contents($path)
            ));
        }
    }
}
