@php
    $block_content = isset($block->pivot->id) && $block->content($block->pivot->id) ? unserialize($block->content($block->pivot->id)->text) : null;
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
                <label class="input__label">{{ __('Title') }}</label>
                <input type="text" class="form-control input-style" name="blocks[{{ $block->pivot->id }}][title]" value="{{ $block_content['title'] ?? null }}">
            </div>
            <div class="form-group">
                <label class="input__label">{{ __('Steps') }}</label>
                <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][step_1]" value="{{ $block_content['step_1'] ?? null }}" placeholder="Step 1">
                <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][step_2]" value="{{ $block_content['step_2'] ?? null }}" placeholder="Step 2">
                <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][step_3]" value="{{ $block_content['step_3'] ?? null }}" placeholder="Step 3">
                <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][step_4]" value="{{ $block_content['step_4'] ?? null }}" placeholder="Step 4">
            </div>
            <div class="form-group">
                <label class="input__label">{{ __('Input placeholder') }}</label>
                <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][input_placeholder]" value="{{ $block_content['input_placeholder'] ?? null }}" placeholder="Input placeholder">
            </div>
            <div class="form-group">
                <label class="input__label">{{ __('Textarea placeholder') }}</label>
                <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][textarea_placeholder]" value="{{ $block_content['textarea_placeholder'] ?? null }}" placeholder="Textarea placeholder">
            </div>
            <div class="form-group">
                <label class="input__label">{{ __('Tooltip') }}</label>
                <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][tooltip]" value="{{ $block_content['tooltip'] ?? null }}" placeholder="Tooltip">
            </div>
        </div>
    </div>
</div>
