@if($page->template->blocks->count())
    @foreach($page->template->blocks as $block)
        @if($block->id == 1)
            @include('backend.pages.blocks._banner')
        @elseif($block->id == 2)
            @include('backend.pages.blocks._text_block')
        @elseif($block->id == 3)
            @include('backend.pages.blocks._price_banner')
        @elseif($block->id == 4)
            @include('backend.pages.blocks._information_banner')
        @elseif($block->id == 5)
            @include('backend.pages.blocks._ratting')
        @elseif($block->id == 6)
            @include('backend.pages.blocks._conclusion_generator')
        @elseif($block->id == 7)
            @include('backend.pages.blocks._paraphrasing_tool')
        @endif
    @endforeach
@endif
