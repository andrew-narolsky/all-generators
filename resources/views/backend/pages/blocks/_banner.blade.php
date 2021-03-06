@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
@endphp
@if($block_content)
    <div class="conclusion-generator-banner">
        <div class="wrap">
            <div class="h2">{{ $block_content['title'] ?? null }}</div>
            <p>{!! $block_content['content'] ?? null !!}</p>
            <a href="{{ $block_content['button_link'] ?? null }}" class="button green">{{ $block_content['button_text'] ?? null }}</a>
        </div>
    </div>
@endif
