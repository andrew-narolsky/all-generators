<?php

namespace App\Http\Controllers\ParaphrasingTool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ParaphrasingToolController extends Controller
{
    const PARAPHRASING_API_URL = 'https://www.prepostseo.com/apis/checkparaphrase';
    const PARAPHRASING_API_KEY = '9e3e3c760b40035f9764c695c4fb8fd0';

    public function getParaphrasingText(Request $request)
    {
//        $response = Http::asForm()->post(self::PARAPHRASING_API_URL, [
//            'key' => self::PARAPHRASING_API_KEY,
//            'data' => $request->get('text'),
//            'lang' => 'en',
//            'mode' => 'Simple',
//        ]);
//        return $response;
        return '{"queriesUsed":1,"originalContent":"On our website, students and learners can find detailed writing guides, free essay samples, fresh topic ideas, formatting rules, citation tips, and inspiration to study.","paraphrasedContent":"On our website, <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"students|college students\">college students<\/b> and <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"learners|beginners|newbies|novices|rookies|newcomers|freshmen|inexperienced persons\">freshmen<\/b> can <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"find|discover|locate\">locate<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"detailed|specific|particular|certain|precise|unique|distinct|exact|special|specified|targeted|designated|distinctive\">specific<\/b> writing guides, <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"free|loose|unfastened\">unfastened<\/b> essay samples, <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"fresh|clean|sparkling\">clean<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"topic|subject matter\">subject matter<\/b> ideas, formatting rules, <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"citation|quotation\">quotation<\/b> tips, and <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"inspiration|idea|concept|thought|notion|proposal|suggestion\">proposal<\/b> to study."}';
    }
}
