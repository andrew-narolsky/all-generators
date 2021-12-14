@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
@endphp
@if($block_content)
    <div class="ideal-match mt-0">
        <div class="wrap">
            <div class="prices">
                <div class="subtitle">{{ $block_content['excerpt'] ?? null }}</div>
                <div class="title">{!! $block_content['content'] ?? null !!}</div>
                <a href="{{ $block_content['button_link'] ?? null }}" class="button green">{{ $block_content['button_text'] ?? null }}</a>
            </div>
        </div>
    </div>
@endif
