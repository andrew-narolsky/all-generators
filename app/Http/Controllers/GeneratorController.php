<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Page;
use Carbon\Carbon;

class GeneratorController extends Controller
{
    protected object $attempt;
    protected object $carbon;
    protected object $page;

    public int $id;

    public function __construct(Page $page, Attempt $attempt, Carbon $carbon, int $id)
    {
        $this->page = $page;
        $this->attempt = $attempt;
        $this->carbon = $carbon;
        $this->id = $id;
    }

    public function getPageStars() : object
    {
        return $this->page::select('count_votes', 'stars')->find($this->id);
    }

    public function setPageStars() : int
    {
        $page = $this->page::find($this->id);
        $page->update(['count_votes' => ($page->count_votes + 1)]);
        return $page->count_votes;
    }

    protected function isUseCyrillicText(string $text) : bool
    {
        return preg_match('/[а-яё]/i', $text);
    }

    protected function getAttemptsCount(string $ip, int $tool) : int
    {
        return $this->attempt::where('API', $ip)->where('tool', $tool)->whereDate('created_at', $this->carbon::today())->get()->count();
    }
}
