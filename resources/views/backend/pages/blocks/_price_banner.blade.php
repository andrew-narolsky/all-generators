@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
@endphp
@if($block_content)
    <div class="ideal-match">
        <div class="wrap">
            <div class="prices">
                <div class="subtitle">{{ $block_content['excerpt'] }}</div>
                <div class="title">{!! $block_content['content'] !!}</div>
                <a href="{{ $block_content['button_link'] }}" class="button green">{{ $block_content['button_text'] }}</a>
            </div>
        </div>
    </div>
@endif
