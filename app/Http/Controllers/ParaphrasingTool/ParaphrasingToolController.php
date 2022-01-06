<?php

namespace App\Http\Controllers\ParaphrasingTool;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

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
        $response = '{"queriesUsed":1,"originalContent":"While all this information may seem like a lot, in fact, it offers a rigid framework that structurizes your writing thus making it easier to digest. If you find formatting your paper difficult, use EdTech tools. With their help, you\'ll research information faster and process it easier. They also can help you memorize the APA formatting rules.","paraphrasedContent":"While all this <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"information|data|facts|statistics|records|facts|statistics|records\">statistics<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"may|may also|can also additionally|might also additionally\">can also additionally<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"seem like|look like|appear to be|appear like\">appear like<\/b> a lot, in fact, it <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"offers|gives\">gives<\/b> a <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"rigid|inflexible\">inflexible<\/b> framework that structurizes your writing <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"thus|therefore|consequently|as a result|for that reason|hence|accordingly|for this reason|as a consequence\">accordingly<\/b> making it <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"easier|simpler|less difficult|less complicated\">simpler<\/b> to digest. If you <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"find|discover|locate\">discover<\/b> formatting your paper difficult, use EdTech tools. With their help, <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"you\'ll|you will|you may\">you may<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"research|studies\">studies<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"information|data|facts|statistics|records|facts|statistics|records\">statistics<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"faster|quicker\">quicker<\/b> and <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"process|method|technique|procedure|system|manner\">system<\/b> it <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"easier|simpler|less difficult|less complicated\">simpler<\/b>. They <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"also|additionally\">additionally<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"can help you|allow you to|permit you to|let you|assist you to|will let you\">assist you to<\/b> memorize the APA formatting rules."}';
        $excludes = $request->get('excludes');
        $array_excludes = array_map('trim', explode(',', $excludes));
        if ($excludes) {
            $explode = explode('</b>', json_decode($response)->paraphrasedContent);
            // exclude words
            foreach ($explode as $key => $string) {
                foreach ($array_excludes as $search) {
                    if (preg_match("/>$search$/i", $string)) {
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
            return json_encode([
                'paraphrasedContent' => $new_str
            ]);
        } else {
            return $response;
        }
    }
}
