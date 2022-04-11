@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
@endphp
@if($block_content)
    <div class="conclusion-generator">
        <div class="wrap">
            <div class="h1">{!! $block_content['title'] ?? null !!}</div>
            @if($block_content['step_1'])
                <div class="steps">
                    <div class="item"><span>1.</span> {{ $block_content['step_1'] ?? null }}</div>
                    <div class="item"><span>2.</span> {{ $block_content['step_2'] ?? null }}</div>
                    <div class="item"><span>3.</span> {{ $block_content['step_3'] ?? null }}</div>
                    <div class="item"><span>4.</span> {{ $block_content['step_4'] ?? null }}</div>
                </div>
            @endif
            <form class="conclusion_generator">
                @csrf
                <div class="result">
                    <div class="h2">{{ __('Here is Your Summary:') }}</div>
                    <div class="summary">
                        <div class="item">{{ __('Original Length:') }} <span class="original-words">1234567 {{ __('words') }}</span></div>
                        <div class="item">{{ __('Summary Length:') }} <span class="summary-words">1234567 {{ __('words') }}</span></div>
                        <div class="item">{{ __('Summary Ratio:') }} <span class="percent">89%</span></div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="{{ $block_content['input_placeholder'] ?? null }}">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="text" rows="3" placeholder="{{ $block_content['textarea_placeholder'] ?? null }}"></textarea>
                </div>
                <div class="form-group radio-buttons">
                    <div class="text">{{ $block_content['tooltip'] ?? null }}</div>
                    <label class="radio-inline" for="inlineRadio1">
                        <input name="count" checked type="radio" id="inlineRadio1" value="150">
                        <span></span>150 {{ __('words') }}
                    </label>
                    <label class="radio-inline" for="inlineRadio2">
                        <input name="count" type="radio" id="inlineRadio2" value="200">
                        <span></span>200 {{ __('words') }}
                    </label>
                    <label class="radio-inline" for="inlineRadio3">
                        <input name="count" type="radio" id="inlineRadio3" value="300">
                        <span></span>
                        <input type="text" class="form-control ss" name="count_value" placeholder="300">
                    </label>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="button black" id="summarize-button">{{ __('Generate My Conclusion') }}</button>
                </div>
            </form>
        </div>
    </div>
@endif
