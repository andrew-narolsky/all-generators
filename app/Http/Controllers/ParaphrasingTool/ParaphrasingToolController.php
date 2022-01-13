<?php

namespace App\Http\Controllers\ParaphrasingTool;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\ParaphrasingTool;
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

        ParaphrasingTool::create([
            'text' => $data['text'],
        ]);

        $response = Http::asForm()->post(env('PARAPHRASING_API_URL'), [
            'key' => env('PARAPHRASING_API_KEY'),
            'data' => $request->get('text'),
            'lang' => 'en',
            'mode' => 'Simple',
        ]);
        // $response = '{"paraphrasedContent":"There are many <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"student|scholar|pupil\">scholar<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"services|offerings\">offerings<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"on the market|available in the marketplace\">available in the marketplace<\/b> that <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"deliver|supply\">supply<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"similar|comparable\">comparable<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"academic|educational|instructional\">instructional<\/b> assistance. The <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"question|query\">query<\/b> is, are <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"all of them|they all\">they all<\/b> credible enough. At Grab My Essay.com <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"every|each\">each<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"customer|client|purchaser|consumer|patron\">consumer<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"gets|receives\">receives<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"more|extra|greater\">extra<\/b> than <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"fulfillment|achievement|success\">success<\/b> of write my essay for me request. Consider us as your <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"personal|private|non-public\">non-public<\/b> writing <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"consultant|representative\">representative<\/b> that <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"is ready|is prepared\">is prepared<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"to help you|that will help you\">that will help you<\/b> and <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"save|store|keep|shop\">shop<\/b> your grades 24\/7. Every <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"team|group|crew\">group<\/b> member is your <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"friend|pal|buddy\">buddy<\/b>, adviser, and <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"friend|pal|buddy\">buddy<\/b> who <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"indeed|certainly\">certainly<\/b> cares <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"about|approximately\">approximately<\/b> your <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"college|university\">university<\/b> performance.\n\nTwo General APA Concepts\nFirstly, an APA <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"style|fashion\">fashion<\/b> paper <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"can be|may be\">may be<\/b> used for <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"scientific|clinical|medical\">medical<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"research|studies\">studies<\/b> papers <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"in order to|so that you can|so as to|to be able to|that allows you to|with a view to|with a purpose to|so one can|in an effort to|with the intention to|on the way to|as a way to|which will|a good way to|if you want to|for you to|so that it will\">a good way to<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"present|gift\">gift<\/b> an <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"existing|present|current\">present<\/b> and <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"proven|confirmed|established|tested|verified|demonstrated|validated\">verified<\/b> theory. This <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"means|way|method|approach|manner\">approach<\/b> that the paper <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"must|have to|need to|ought to|should\">need to<\/b> be written <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"using|the use of|the usage of\">the use of<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"present|gift\">gift<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"perfect|ideal|best\">ideal<\/b> or <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"past|beyond\">beyond<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"tense|stressful|annoying|demanding|traumatic|disturbing|worrying|nerve-racking|irritating|aggravating|hectic|anxious\">demanding<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"when|while|whilst\">whilst<\/b> quoting and <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"citing|bringing up|mentioning\">bringing up<\/b> sources.\nSecondly, an APA <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"format|layout\">layout<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"research|studies\">studies<\/b> paper prioritizes the <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"year|yr|12 months\">yr<\/b> of the publication. It <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"should|must|have to|need to|ought to\">have to<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"always|usually|constantly|continually\">constantly<\/b> be featured after <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"each|every\">every<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"name|call\">call<\/b> sourced <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"in the|withinside the\">withinside the<\/b> paper.\nFor example:\n\u201cHarrison (1997) posited that <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"women|girls|ladies\">girls<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"were|have been|had been\">have been<\/b> programmed to nurture their young.\u201d\n\nWhen writing an abstract, <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"it is|it\'s far|it\'s miles\">it\'s far<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"best|fine|great|excellent|first-rate|first-class|exceptional|nice|pleasant|quality|high-quality|satisfactory\">excellent<\/b> to <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"remember|keep in mind|bear in mind|don\'t forget|recall|consider|take into account|do not forget|recollect|don\'t forget\">recall<\/b> that <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"this is|that is\">that is<\/b> the <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"most|maximum\">maximum<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"eye-catching|attractive|appealing|alluring|beautiful|pleasing|desirable|captivating|fascinating\">captivating<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"part of|a part of\">a part of<\/b> the paper. The content, <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"although|even though|despite the fact that\">despite the fact that<\/b> condensed, <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"must|have to|need to|ought to|should\">need to<\/b> be <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"accurate|correct\">correct<\/b> and readable. There <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"is no|isn\'t anyt any\">isn\'t anyt any<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"need|want\">want<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"to add|to feature\">to feature<\/b> a paragraph indentation <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"on this|in this\">in this<\/b> page.\n\nWhile all this <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"information|data|facts|statistics|records|facts|statistics|records\">statistics<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"may|may also|can also additionally|might also additionally\">may also<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"seem like|look like|appear to be|appear like\">appear to be<\/b> a lot, in fact, it <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"offers|gives\">gives<\/b> a <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"rigid|inflexible\">inflexible<\/b> framework that structurizes your writing <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"thus|therefore|consequently|as a result|for that reason|hence|accordingly|for this reason|as a consequence\">as a result<\/b> making it <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"easier|simpler|less difficult|less complicated\">less complicated<\/b> to digest. If you <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"find|discover|locate\">discover<\/b> formatting your paper difficult, use EdTech tools. With their help, <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"you\'ll|you will|you may\">you will<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"research|studies\">studies<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"information|data|facts|statistics|records|facts|statistics|records\">statistics<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"faster|quicker\">quicker<\/b> and <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"process|method|technique|procedure|system|manner\">procedure<\/b> it <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"easier|simpler|less difficult|less complicated\">less complicated<\/b>. They <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"also|additionally\">additionally<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"can help you|allow you to|permit you to|let you|assist you to|will let you\">permit you to<\/b> memorize the APA formatting rules.\n\nThe APA Style <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"can be|may be\">may be<\/b> used for <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"different|unique|special|exclusive|distinctive|one of a kind|exceptional|specific|distinct|extraordinary|one-of-a-kind\">exclusive<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"types of|styles of|sorts of|kinds of|varieties of|forms of\">varieties of<\/b> papers, <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"such as|including|which includes|together with|which include|consisting of|along with|inclusive of\">inclusive of<\/b> essays, theses, dissertations, etc. You <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"can also|also can\">also can<\/b> use <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"these|those\">those<\/b> for argumentative <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"research|studies\">studies<\/b> paper topics, expository essays for minor <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"subjects|topics\">topics<\/b> and any <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"more|extra|greater\">extra<\/b>. Once you get used to this <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"style|fashion\">fashion<\/b> of writing, you won\u2019t <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"have to|need to|ought to|must|should\">must<\/b> refer <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"back|again|returned|lower back\">returned<\/b> to the <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"style|fashion\">fashion<\/b> <b class=\"qtiperar\" style=\"color:black; cursor:pointer\" data-title=\"guides|courses|publications\">courses<\/b> as much."}';
        $excludes = $request->get('excludes');
        $array_excludes = array_map('trim', explode(',', $excludes));
        if ($excludes) {
            $explode = explode('</b>', json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true)['paraphrasedContent']);
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
            return json_encode([
                'paraphrasedContent' => $new_str
            ]);
        } else {
            return $response;
        }
    }
}
