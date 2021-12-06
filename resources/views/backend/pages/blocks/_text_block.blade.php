@php
    $block_content = isset($block->content) ? unserialize($block->content->text) : null;
@endphp
@if($block_content)
    <div class="text-block">
        <div class="wrap">
            <div class="h1">{{ $block->title }}</div>
            <div class="content">
                {!! $block_content['content'] !!}
            </div>
        </div>
    </div>
@endif
