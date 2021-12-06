@php
    $block_content = isset($block->content) ? unserialize($block->content->text) : null;
@endphp
<div class="form-group">
    <div class="card">
        <div class="card-header">
            <h3>{{ $block->title }}</h3>
        </div>
        <div class="card-body">
            <!-- Block attributes -->
            <input type="hidden" name="blocks[{{ $block->pivot->id }}][block_id]" value="{{ $block->id }}">
            <!-- Block attributes -->
            <div class="form-group">
                <label class="input__label">{{ __('Excerpt') }}</label>
                <input type="text" class="form-control input-style" name="blocks[{{ $block->pivot->id }}][excerpt]" value="{{ $block_content['excerpt'] ?? null }}">
            </div>
            <div class="form-group">
                <label class="input__label">{{ __('Content') }}</label>
                <textarea class="form-control" rows="3" name="blocks[{{ $block->pivot->id }}][content]">{{ $block_content['content'] ?? null }}</textarea>
            </div>
            <div class="form-group">
                <label class="input__label">{{ __('Button') }}</label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][button_link]" value="{{ $block_content['button_link'] ?? null }}" placeholder="Button link">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][button_text]" value="{{ $block_content['button_text'] ?? null }}" placeholder="Button text">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
