@if($page->template->blocks->count())
    @foreach($page->template->blocks as $block)
        @if($block->id == 1)
            @include('admin.pages.blocks._banner')
        @elseif($block->id == 2)
            @include('admin.pages.blocks._text_block')
        @elseif($block->id == 3)
            @include('admin.pages.blocks._price_banner')
        @elseif($block->id == 4)
            @include('admin.pages.blocks._information_banner')
        @elseif($block->id == 5)
            @include('admin.pages.blocks._ratting')
        @elseif($block->id == 6)
            @include('admin.pages.blocks._conclusion_generator')
        @endif
    @endforeach
@endif
