@php
    $block_content = isset($block->content) ? unserialize($block->content->text) : null;
@endphp
@if($block_content)
    <div class="banner">
        <div class="wrap">
            <div class="h2">{{ $block_content['title'] }}</div>
            <p>{!! $block_content['content'] !!}</p>
            <a href="{{ $block_content['button_link'] }}" class="button green">{{ $block_content['button_text'] }}</a>
        </div>
    </div>
@endif
