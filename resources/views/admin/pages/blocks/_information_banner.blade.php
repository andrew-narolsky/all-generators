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
                <label class="input__label">{{ __('Title') }}</label>
                <input type="text" class="form-control input-style" name="blocks[{{ $block->pivot->id }}][title]" value="{{ $block_content['title'] ?? null }}">
            </div>
            <div class="form-group">
                <label class="input__label">{{ __('Info blocks') }}</label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][sub_title_1]" value="{{ $block_content['sub_title_1'] ?? null }}" placeholder="Block title 1">
                        <textarea class="form-control" rows="3" name="blocks[{{ $block->pivot->id }}][text_1]" placeholder="Block text 1">{{ $block_content['text_1'] ?? null }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control input-style mb-2" name="blocks[{{ $block->pivot->id }}][sub_title_2]" value="{{ $block_content['sub_title_2'] ?? null }}" placeholder="Block title 2">
                        <textarea class="form-control" rows="3" name="blocks[{{ $block->pivot->id }}][text_2]" placeholder="Block text 2">{{ $block_content['text_2'] ?? null }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
