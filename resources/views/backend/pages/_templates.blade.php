@if($page->template->blocks->count())
    @foreach($page->template->blocks as $block)
        @switch($block->id)
            @case(1)
                @include('backend.pages.blocks._banner')
            @break
            @case(2)
                @include('backend.pages.blocks._text_block')
            @break
            @case(3)
                @include('backend.pages.blocks._price_banner')
            @break
            @case(4)
                @include('backend.pages.blocks._information_banner')
            @break
            @case(5)
                @include('backend.pages.blocks._ratting')
            @break
            @case(6)
                @include('backend.pages.blocks._conclusion_generator')
            @break
            @case(7)
                @include('backend.pages.blocks._paraphrasing_tool')
            @break
            @case(8)
                @include('backend.pages.blocks._faq')
            @break
        @endswitch
    @endforeach
@endif