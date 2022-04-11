@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
@endphp
@if($block_content)
    <div class="essay-maker">
        <div class="wrap">
            <div class="h1">{!! $block_content['title'] ?? null !!}</div>
            <div class="subtitle">{!! $block_content['sub_title'] ?? null !!}</div>
            <div class="h2">{!! $block_content['sub_title_2'] ?? null !!}</div>
            <p>{!! $block_content['sub_text'] ?? null !!}</p>
            <div class="steps">
                <div class="item"><span>1.</span> {{ $block_content['step_1'] ?? null }}</div>
                <div class="item"><span>2.</span> {{ $block_content['step_2'] ?? null }}</div>
                <div class="item"><span>3.</span> {{ $block_content['step_3'] ?? null }}</div>
            </div>
            <form class="essay_maker">
                @csrf
                <div class="form-wrap">
                    <div class="form-group input-wrap">
                        <input type="text" name="text" placeholder="{{ $block_content['input_placeholder'] ?? null }}">
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group submit">
                        <button type="submit" id="summarize-button" class="button black">{{ __('Create My Essay') }}</button>
                    </div>
                </div>
                <div class="result-text-wrap">
                    <div class="svg-loader">
                        <img src="{{ asset('/backend/img/svg-loader.svg') }}" alt="loader">
                        <p>{{ __('Your essay is on its way...') }}</p>
                        <p><strong>{{ __('Generating Essay...') }}</strong></p>
                    </div>
                    <div class="limit-error">
                        <div class="h3">{{ __('Oops!') }}</div>
                        <p>{{ __('You’ve reached your daily limit of 3 automatically generated essays.') }}</p>
                        <p>{{ __('Please come back tomorrow or you can order the original paper on our website right now.') }}</p>
                        <a href="#" class="button green">{{ __('Get Essay Today') }}</a>
                    </div>
                </div>
                <textarea class="result-text"></textarea>
                <div class="buttons">
                    <div class="top">
                        <button class="clear-text">
                            <img src="{{ asset('/backend/img/delete.svg') }}" alt="delete">
                            <div class="tooltip">{{ __('Clear all text') }}</div>
                        </button>
                    </div>
                    <div class="bottom">
                        <button class="copy-text">
                            <img src="{{ asset('/backend/img/copy.svg') }}" alt="copy">
                            <div class="tooltip">{{ __('Copied to clipboard') }}</div>
                        </button>
                        <div class="download-text">
                            <button>
                                <img src="{{ asset('/backend/img/download.svg') }}" alt="download">
                            </button>
                            <div class="tooltip">
                                <div class="download-links">
                                    <a href="#" class="pdf" download="download" target="_blanck">
                                        <img src="{{ asset('/backend/img/pdf.svg') }}" alt="pdf">
                                    </a>
                                    <a href="#" class="doc" download="download" target="_blanck">
                                        <img src="{{ asset('/backend/img/doc.svg') }}" alt="doc">
                                    </a>
                                    <a href="#" class="docx" download="download" target="_blanck">
                                        <img src="{{ asset('/backend/img/docx.svg') }}" alt="docx">
                                    </a>
                                </div>
                                <div class="close-tooltip">
                                    <img src="{{ asset('/backend/img/cross.svg') }}" alt="cross">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-block">
                    <div class="text">{{ $block_content['info_text'] ?? null }}</div>
                    <a href="#" class="button green reload">{{ __('Generate Again') }}</a>
                    <a href="#" class="button black">{{ __('Get Unique Paper') }}</a>
                </div>
            </form>
        </div>
    </div>
@endif
