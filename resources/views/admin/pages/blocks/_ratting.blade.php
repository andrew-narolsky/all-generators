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
        </div>
    </div>
</div>
