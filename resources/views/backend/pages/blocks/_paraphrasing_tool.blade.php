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
                <div class="form-group">
                    <textarea class="form-control" name="text" rows="3" placeholder="{{ $block_content['textarea_placeholder'] ?? null }}"></textarea>
                    <div class="result-text">On our website, <b class="qtiperar" style="color:black; cursor:pointer" data-title="students|college students">college students<span class="qtiperar-tooltip"><span>students</span><span>college students</span><span class="close"></span></span></b> and <b class="qtiperar" style="color:black; cursor:pointer" data-title="learners|beginners|newbies|novices|rookies|newcomers|freshmen|inexperienced persons">freshmen</b> can <b class="qtiperar" style="color:black; cursor:pointer" data-title="find|discover|locate">locate</b> <b class="qtiperar" style="color:black; cursor:pointer" data-title="detailed|specific|particular|certain|precise|unique|distinct|exact|special|specified|targeted|designated|distinctive">specific</b> writing guides, <b class="qtiperar" style="color:black; cursor:pointer" data-title="free|loose|unfastened">unfastened</b> essay samples, <b class="qtiperar" style="color:black; cursor:pointer" data-title="fresh|clean|sparkling">clean</b> <b class="qtiperar" style="color:black; cursor:pointer" data-title="topic|subject matter">subject matter</b> ideas, formatting rules, <b class="qtiperar" style="color:black; cursor:pointer" data-title="citation|quotation">quotation</b> tips, and <b class="qtiperar" style="color:black; cursor:pointer" data-title="inspiration|idea|concept|thought|notion|proposal|suggestion">proposal</b> to study.</div>
                </div>
                <div class="form-group">
                    <input type="text" name="excludes" class="form-control" placeholder="{{ $block_content['input_placeholder'] ?? null }}">
                </div>
                <div class="form-group radio-buttons">
                    <div class="text">{{ __('Simple mode:') }}</div>
                    <label class="radio-inline" for="inlineRadio1">
                        <input name="mode" checked type="radio" id="inlineRadio1" value="simple">
                        <span></span>{{ __('Simple') }}
                    </label>
                    <label class="radio-inline" for="inlineRadio2">
                        <input name="mode" type="radio" id="inlineRadio2" value="advance">
                        <span></span>{{ __('Advance') }}
                    </label>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="button black" id="summarize-button">{{ __('Rephrase') }}</button>
                </div>
            </form>
        </div>
    </div>
@endif
