<?php

namespace App\Http\Controllers\EssayMaker;

use App\Http\Controllers\GeneratorController;
use App\Mail\ErrorMail;
use App\Models\Attempt;
use App\Models\EssayMaker;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EssayMakerController extends GeneratorController
{
    const GENERATOR_PAGE_ID = 3;

    protected object $validator;
    protected object $essayMaker;
    protected object $http;
    protected object $mail;
    protected object $errorMail;

    public function __construct(Page $page, Attempt $attempt, Validator $validator, Carbon $carbon, EssayMaker $essayMaker, Http $http, Mail $mail)
    {
        parent::__construct($page, $attempt, $carbon, self::GENERATOR_PAGE_ID);

        $this->validator = $validator;
        $this->essayMaker = $essayMaker;
        $this->http = $http;
        $this->mail = $mail;
        $this->errorMail = new ErrorMail(env('ESSAY_MAKER_API_URL'));
    }

    public function getResultText(Request $request) : object {
        $data = $request->only('text');

        $rules = [
            'text' => 'required|min:3',
        ];

        $message = [
            'text.required' => 'You must provide a text that is 3 characters long.',
            'text.min' => 'You must provide a text that is 3 characters long.',
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

//        $result = $this->http::asForm()->post(env('ESSAY_MAKER_API_URL'), [
//            'apikey' => env('ESSAY_MAKER_API_KEY'),
//            'keyword' => $request->get('text'),
//            'wordcount' => 1000,
//        ]);

        $result = '{
            "result": "The US will start screening at three airports for passengers with the mysterious, novel poison begin in Wuhan........",
            "wordcount": 1530,
            "instanceID": "5e2aa7f45c01a",
            "executionTime": 10.403473854065,
            "computeTime": 10.402873039246,
            "responseID": "7090c0a12fe38f775be9e5feba0f2327",
            "quota": 9979
        }';

        if (isset(json_decode($result)->error)) {
            // send mail
            $this->mail::to(env('ADMIN_EMAIL'))->send($this->errorMail);
            return response()->json([
                'errors' => [
                    'text' => 'Error! Try later'
                ]
            ], 422);
        }

        $this->essayMaker::create([
            'text' => json_decode($result)->result,
        ]);

        return json_decode($result);
    }
}
