@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
@endphp
@if($block_content)
    <div class="form paraphrasing-tool">
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
            <form class="paraphrasing_tool">
                @csrf
                <div class="form-group text-wrap">
                    <input type="hidden" id="text">
                    <textarea class="form-control" name="text" rows="3" placeholder="{{ $block_content['textarea_placeholder'] ?? null }}"></textarea>
                    <div class="result-text"></div>
                    <div class="svg-loader">
                        <img src="{{ asset('/backend/img/svg-loader.svg') }}" alt="loader">
                    </div>
                    <div class="buttons">
                        <div class="top">
                            <div class="clear-text">
                                <img src="{{ asset('/backend/img/delete.svg') }}" alt="delete">
                            </div>
                            <div class="action back-action">
                                <img src="{{ asset('/backend/img/prev.svg') }}" alt="prev">
                            </div>
                            <div class="action next-action">
                                <img src="{{ asset('/backend/img/next.svg') }}" alt="next">
                            </div>
                        </div>
                        <div class="bottom">
                            <div class="copy-text">
                                <img src="{{ asset('/backend/img/copy.svg') }}" alt="copy">
                                <div class="tooltip">Copied to clipboard</div>
                            </div>
                            <div class="download-text">
                                <img src="{{ asset('/backend/img/download.svg') }}" alt="download">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="excludes" class="form-control" placeholder="{{ $block_content['input_placeholder'] ?? null }}">
                </div>
                <div style="width: 50%;"></div>
                <div class="form-group submit">
                    <button type="submit" class="button black" id="summarize-button">{{ __('Rephrase') }}</button>
                </div>
            </form>
        </div>
    </div>
@endif
