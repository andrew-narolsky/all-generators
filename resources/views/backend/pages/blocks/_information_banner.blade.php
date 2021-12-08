@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
@endphp
@if($block_content)
    <div class="ideal-match">
        <div class="wrap">
            <div class="h1">{{ $block_content['title'] }}</div>
            <div class="steps">
                <div class="item">
                    <img src="{{ asset('backend/img/pic.png') }}" alt="">
                    <div class="info">
                        <div class="title">{{ $block_content['sub_title_1'] }}</div>
                        <p>{{ $block_content['text_1'] }}</p>
                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('backend/img/pic1.png') }}" alt="">
                    <div class="info">
                        <div class="title">{{ $block_content['sub_title_2'] }}</div>
                        <p>{{ $block_content['text_2'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
