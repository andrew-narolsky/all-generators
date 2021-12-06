<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->envUpdate('ADMIN_NAME', $request->name);
        $this->envUpdate('ADMIN_EMAIL', $request->email);
        $this->envUpdate('APP_MAIN_URL', $request->url);
        session()->flash('success', 'Settings was updated!');
        return redirect()->route('settings.index');
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
