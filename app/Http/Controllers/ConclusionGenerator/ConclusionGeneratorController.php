<?php

namespace App\Http\Controllers\ConclusionGenerator;

use App\Http\Controllers\GeneratorController;
use App\Models\Attempt;
use App\Models\ConclusionGenerator;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConclusionGeneratorController extends GeneratorController
{
    const MINIMUM_SENTENCES_LIMIT = 5;
    const MINIMUM_WORDS_LIMIT = 200;
    const GENERATOR_PAGE_ID = 1;

    protected object $validator;
    protected object $conclusionGenerator;

    public function __construct(Page $page, Attempt $attempt, Validator $validator, Carbon $carbon, ConclusionGenerator $conclusionGenerator)
    {
        parent::__construct($page, $attempt, $carbon, self::GENERATOR_PAGE_ID);

        $this->validator = $validator;
        $this->conclusionGenerator = $conclusionGenerator;
    }

    public function getResultText(Request $request) : object {
        $data = $request->only('title', 'text', 'count');

        $rules = [
            'title' => 'required|between:1,100',
            'text' => 'required|min:1|max:15000',
        ];

        $message = [
            'title.required' => 'You must provide a title that is between 1 and 100 characters.',
            'title.between' => 'You must provide a title that is between 1 and 100 characters.',
            'text.required' => 'You must provide a text that is at least 200 words',
            'text.min' => 'You must provide a text that is at least 200 words',
            'text.max' => '15000 characters MAX.',
        ];

        $validator = $this->validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return response()->json( ['errors' => $validator->errors()], 422);
        }

        $minimum_words_limit = self::MINIMUM_WORDS_LIMIT;
        $word_count = count(preg_split('/\s+/u', $data['text'], null, PREG_SPLIT_NO_EMPTY));

        if (preg_match('/[а-яё]/i', $data['text'])) {
            return response()->json(['errors' => ['text' => ['You must provide a text that is written in Latin characters']]], 422);
        }

        if ($word_count < $minimum_words_limit) {
            return response()->json(['errors' => ['text' => ['You must provide a text that is at least ' . $minimum_words_limit . ' words.']]], 422);
        }

        if ($word_count < $data['count']) {
            return response()->json(['errors' => ['text' => ['The original text must contain more words than the summary']]], 422);
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

            $this->conclusionGenerator::create([
                'title' => $data['title'],
                'text' => $data['text'],
            ]);

            return response()->json(['errors' => [], 'text' => $text], 200);
        } else {
            return response()->json(['errors' => ['text' => ['You must provide a text that is at least ' . self::MINIMUM_SENTENCES_LIMIT . ' sentences long.']]], 422);
        }
    }
}
