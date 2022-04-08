<?php

namespace App\Http\Controllers\ParaphrasingTool;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Page;
use App\Models\ParaphrasingTool;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ParaphrasingToolController extends Controller
{
    const CONCLUSION_GENERATOR_PAGE_ID = 2;

    public function getPageStars()
    {
        $page = Page::select('count_votes', 'stars')->find(self::CONCLUSION_GENERATOR_PAGE_ID);
        return $page;
    }

    public function setPageStars()
    {
        $page = Page::find(self::CONCLUSION_GENERATOR_PAGE_ID);
        $page->update(['count_votes' => ($page->count_votes + 1)]);
        return $page->count_votes;
    }

    public function paraphrasingText(Request $request)
    {
        $data = $request->only('text');

        $rules = [
            'text' => 'required|min:1000|max:5000',
        ];

        $message = [
            'text.required' => 'You must provide a text that is 1000 characters long.',
            'text.min' => 'You must provide a text that is 1000 characters long.',
            'text.max' => '5000 characters MAX.',
        ];

        $validator = Validator::make($data, $rules, $message);

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

//        if ($this->getAttemptsCount($request->ip(), self::CONCLUSION_GENERATOR_PAGE_ID) > 3) {
//            return response()->json([
//                'errors' => [
//                    'text' => 'You reached your daily limit of 3 paraphrasing inquiries',
//                ]
//            ], 401);
//        }

//        Attempt::create([
//            'API' => $request->ip(),
//            'tool' => self::CONCLUSION_GENERATOR_PAGE_ID,
//        ]);
//
//        ParaphrasingTool::create([
//            'text' => $data['text'],
//        ]);

        $response = Http::asForm()->post(env('PARAPHRASING_API_URL'), [
            'key' => env('PARAPHRASING_API_KEY'),
            'data' => $request->get('text'),
            'lang' => 'en',
            'mode' => 'Simple',
        ]);

        // excludes
        $excludes = $request->get('excludes');
        $array_excludes = array_map('trim', explode(',', $excludes));
        if ($excludes) {
            return json_encode([
                'paraphrasedContent' => $this->removeExcludesWords($response, $array_excludes)
            ]);
        } else {
            return $response;
        }
    }

    protected function isUseCyrillicText($text)
    {
        return preg_match('/[а-яё]/i', $text);
    }

    protected function getAttemptsCount($ip, $tool)
    {
        return Attempt::where('API', $ip)->where('tool', $tool)->whereDate('created_at', Carbon::today())->get()->count();
    }

    protected function removeExcludesWords($response, $array_excludes)
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
