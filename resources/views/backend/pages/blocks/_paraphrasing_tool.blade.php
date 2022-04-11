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
                <div class="form-group text-wrap textarea-wrap">
                    <input type="hidden" id="text">
                    <textarea class="form-control" name="text" rows="3" placeholder="{{ $block_content['textarea_placeholder'] ?? null }}"></textarea>
                    <div class="result-text-wrap">
                        <div class="result-text"></div>
                    </div>
                    <div class="words-count-wrap">
                        <div class="words-count">Characters: <span>0</span></div>
                    </div>
                    <div class="svg-loader">
                        <img src="{{ asset('/backend/img/svg-loader.svg') }}" alt="loader">
                    </div>
                    <div class="buttons">
                        <div class="top">
                            <button class="clear-text">
                                <img src="{{ asset('/backend/img/delete.svg') }}" alt="delete">
                                <div class="tooltip">Clear all text</div>
                            </button>
                            <button class="action back-action" disabled="disabled">
                                <img src="{{ asset('/backend/img/prev.svg') }}" alt="prev">
                            </button>
                            <button class="action next-action" disabled="disabled">
                                <img src="{{ asset('/backend/img/next.svg') }}" alt="next">
                            </button>
                        </div>
                        <div class="bottom">
                            <button class="copy-text">
                                <img src="{{ asset('/backend/img/copy.svg') }}" alt="copy">
                                <div class="tooltip">Copied to clipboard</div>
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
                </div>
                <div class="form-group input-wrap">
                    <textarea type="text" name="excludes" class="form-control input" placeholder="{{ $block_content['input_placeholder'] ?? null }}"></textarea>
                </div>
                <div class="form-group radio-buttons">
                    <div class="text">Need better results? <a href="#">Get expert editing help!</a></div>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="button black" id="summarize-button">{{ __('Rephrase') }}</button>
                </div>
            </form>
        </div>
    </div>
@endif
