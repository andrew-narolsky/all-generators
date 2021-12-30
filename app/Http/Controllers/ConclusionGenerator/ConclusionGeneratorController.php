<?php

namespace App\Http\Controllers\ConclusionGenerator;

use App\Models\ConclusionGenerator;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ConclusionGeneratorController extends Controller
{
    const MINIMUM_SENTENCES_LIMIT = 5;
    const MINIMUM_WORDS_LIMIT = 200;
    const CONCLUSION_GENERATOR_PAGE_ID = 1;

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

    public function summarizeText(Request $request)
    {
        $data = $request->only('title', 'text', 'count');

        $rules = [
            'title' => 'required|between:1,100',
            'text' => 'required|min:1000|max:15000',
        ];

        $message = [
            'title.required' => 'You must provide a title that is between 1 and 100 characters.',
            'title.between' => 'You must provide a title that is between 1 and 100 characters.',
            'text.required' => 'You must provide a text that is at least 200 words or 1000 characters long.',
            'text.min' => 'You must provide a text that is at least 200 words or 1000 characters long.',
            'text.max' => '15000 characters MAX.',
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return response()->json( ['errors' => $validator->errors()], 422);
        }

        $minimum_words_limit = (int)$data['count'] ?? self::MINIMUM_WORDS_LIMIT;
        $word_count = count(preg_split('/\s+/u', $data['text'], null, PREG_SPLIT_NO_EMPTY));

        if ($word_count < $minimum_words_limit) {
            return response()->json( ['errors' => ['text' => ['You must provide a text that is at least ' . $minimum_words_limit . ' words or 1000 characters long.']]], 422);
        }

        $items = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $data['text']);

        if (count($items) >= self::MINIMUM_SENTENCES_LIMIT) {
            $limit = ceil(count($items) * ((int)$data['count'] / $word_count));
            $keys = array_rand($items, $limit);

            if (is_array($keys)) {
                foreach ($items as $key => $item) {
                    if (array_search($key, $keys) === false) {
                        unset($items[$key]);
                    }
                }
                $text = implode(' ', $items);
            } else {
                $text = $items[$keys];
            }

            ConclusionGenerator::create([
                'title' => $data['title'],
                'text' => $data['text'],
            ]);

            return response()->json(['errors' => [], 'text' => $text], 200);
        } else {
            return response()->json( ['errors' => ['text' => ['You must provide a text that is at least ' . self::MINIMUM_SENTENCES_LIMIT . ' sentences long.']]], 422);
        }
    }
}
