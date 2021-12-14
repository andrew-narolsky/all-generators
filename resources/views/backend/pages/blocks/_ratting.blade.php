@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
@endphp
@if($block_content)
    <div class="ratting" data-page="{{ $page->id }}">
        <div class="wrap">
            <div class="title">{{ $block_content['title'] ?? null }}</div>
            <div class="stars">
                @for($i = 1; $i <= 5; $i++)
                <label for="rate_{{ $i }}" @if($i <= $page->stars) class="active" @endif>
                    <input type="radio" name="rate" value="{{ $i }}" id="rate_{{ $i }}">
                </label>
                @endfor
            </div>
            <div class="votes">Votes: <span>{{ $page->count_votes }}</span></div>
        </div>
    </div>
@endif
