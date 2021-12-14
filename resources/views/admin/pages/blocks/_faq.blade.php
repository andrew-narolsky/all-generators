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
                <label class="input__label">{{ __('Sub title') }}</label>
                <input type="text" class="form-control input-style" name="blocks[{{ $block->pivot->id }}][subtitle]" value="{{ $block_content['subtitle'] ?? null }}">
            </div>
            <div class="faqs">
                @if(!isset($block_content['faq']))
                    <div class="faq-row faq-row-1">
                        <div class="form-group">
                            <label class="input__label">{{ __('Question 1') }}</label>
                            <input type="text" class="form-control input-style" name="blocks[{{ $block->pivot->id }}][faq][1][question]" value="">
                        </div>
                        <div class="form-group">
                            <label class="input__label">{{ __('Answer 1') }}</label>
                            <textarea class="form-control ckeditor" id="ckeditor_{{ $block->pivot->id }}_1" name="blocks[{{ $block->pivot->id }}][faq][1][answer]" rows="3"></textarea>
                        </div>
                    </div>
                @else
                    @foreach($block_content['faq'] as $key => $item)
                        <div class="faq-row faq-row-{{ $key }}">
                            <div class="form-group">
                                <label class="input__label" style="display: flex; justify-content: space-between; align-items: center">{{ __('Question') }}
                                    @if($key != 1)
                                        <button class="btn btn-danger btn-sm delete-row" data-id="{{ $key }}">
                                            <i class="fas fas fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </label>
                                <input type="text" class="form-control input-style" name="blocks[{{ $block->pivot->id }}][faq][{{ $key }}][question]" value="{{ $item['question'] ?? null }}">
                            </div>
                            <div class="form-group">
                                <label class="input__label">{{ __('Answer') }}</label>
                                <textarea class="form-control ckeditor" id="ckeditor_{{ $block->pivot->id }}_{{ $key }}" name="blocks[{{ $block->pivot->id }}][faq][{{ $key }}][answer]" rows="3">{{ $item['answer'] ?? null }}</textarea>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                <a href="#" class="btn btn-success" id="add_faq_block">
                    <i class="fas fa-plus"></i>
                    {{ __(' Add row') }}
                </a>
            </div>
        </div>
    </div>
</div>
