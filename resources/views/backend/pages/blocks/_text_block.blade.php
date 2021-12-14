@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
@endphp
@if($block_content)
    <div class="text-block">
        <div class="wrap">
            <div class="h1">{{ $block_content['title'] ?? null }}</div>
            <div class="content">
                {!! $block_content['content'] ?? null !!}
            </div>
        </div>
    </div>
@endif
