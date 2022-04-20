<?php

namespace App\Http\Controllers\ParaphrasingTool;

use App\Http\Controllers\GeneratorController;
use App\Mail\ErrorMail;
use App\Models\Attempt;
use App\Models\Page;
use App\Models\ParaphrasingTool;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ParaphrasingToolController extends GeneratorController
{
    const GENERATOR_PAGE_ID = 2;

    protected object $validator;
    protected object $paraphrasingTool;
    protected object $http;
    protected object $mail;
    protected object $errorMail;

    public function __construct(Page $page, Attempt $attempt, Validator $validator, Carbon $carbon, ParaphrasingTool $paraphrasingTool, Http $http, Mail $mail)
    {
        parent::__construct($page, $attempt, $carbon, self::GENERATOR_PAGE_ID);

        $this->validator = $validator;
        $this->paraphrasingTool = $paraphrasingTool;
        $this->http = $http;
        $this->mail = $mail;
        $this->errorMail = new ErrorMail(env('PARAPHRASING_API_URL'));
    }

    public function getResultText(Request $request) : object {
        $data = $request->only('text');

        $rules = [
            'text' => 'required|min:1000|max:5000',
        ];

        $message = [
            'text.required' => 'You must provide a text that is 1000 characters long.',
            'text.min' => 'You must provide a text that is 1000 characters long.',
            'text.max' => '5000 characters MAX.',
        ];

        $validator = $this->validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($this->isUseCyrillicText($data['text'])) {
            return response()->json([
                'errors' => [
                    'text' => 'You must provide a text that is written in Latin characters'
                ]
            ], 422);
        }

        if ($this->getAttemptsCount($request->ip(), self::GENERATOR_PAGE_ID) > 3) {
            return response()->json([
                'errors' => [
                    'text' => 'You reached your daily limit of 3 paraphrasing inquiries',
                ]
            ], 401);
        }

        $this->attempt::create([
            'API' => $request->ip(),
            'tool' => self::GENERATOR_PAGE_ID,
        ]);

        $this->paraphrasingTool::create([
            'text' => $data['text'],
        ]);

        $response = $this->http::asForm()->post(env('PARAPHRASING_API_URL'), [
            'key' => env('PARAPHRASING_API_KEY'),
            'data' => $request->get('text'),
            'lang' => 'en',
            'mode' => 'Simple',
        ]);

        if (isset(json_decode($response)->error)) {
            // send mail
            $this->mail::to(env('ADMIN_EMAIL'))->send($this->errorMail);
            return response()->json([
                'errors' => [
                    'text' => 'Error! Try later'
                ]
            ], 422);
        }

        // excludes
        $excludes = $request->get('excludes');
        $array_excludes = array_map('trim', explode(',', $excludes));
        if ($excludes) {
            return response()->json([
                'paraphrasedContent' => $this->removeExcludesWords($response, $array_excludes)
            ]);
        } else {
            return $response;
        }
    }

    protected function removeExcludesWords($response, $array_excludes) : string
    {
        $explode = explode('</b>', json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), false)->paraphrasedContent);
        // exclude words
        foreach ($explode as $key => $string) {
            foreach ($array_excludes as $search) {
                if (preg_match("#data-title=\"$search\|#i", $string)) {
                    $arr = explode('<b ', $string);
                    $explode[$key] = $arr[0] . $search;
                }
            }
        }
        // array to string
        $new_str = '';
        foreach ($explode as $string) {
            $new_str .= $string . '</b>';
        }
        return $new_str;
    }
}
