@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
@endphp
@if($block_content)
    <section class="faq">
        <h3 class="faq__title">{{ $block_content['title'] ?? null }}</h3>
        <div class="faq__subtitle">
            <h3 class="faq__subtitle-item bg-pink">{{ $block_content['subtitle'] ?? null }}</h3>
        </div>
        @if(isset($block_content['faq']))
            <div class="faq__content" itemscope="" itemtype="https://schema.org/FAQPage">
                @foreach($block_content['faq'] as $key => $item)
                    <div class="faq__item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <div class="faq__name">
                            <h4 class="faq__name-title" itemprop="name"> {{ $item['question'] ?? null }}</h4><span class="faq__name-icon"></span>
                        </div>
                        <div class="faq__value" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" style="display: none">
                            <div class="faq__inner text_holder_block" itemprop="text">
                                {!! $item['answer'] ?? null !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endif
