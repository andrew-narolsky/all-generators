@php
    $block_content = isset($block->content) ? unserialize($block->content->text) : null;
@endphp
@if($block_content)
    <div class="ratting">
        <div class="wrap">
            <div class="title">{{ $block_content['title'] }}</div>
            <div class="stars">
                <label for="rate_1" class="active">
                    <input type="radio" name="rate" value="1" id="rate_1">
                </label>
                <label for="rate_2" class="active">
                    <input type="radio" name="rate" value="2" id="rate_2">
                </label>
                <label for="rate_3" class="active">
                    <input type="radio" name="rate" value="3" id="rate_3">
                </label>
                <label for="rate_4" class="active">
                    <input type="radio" name="rate" value="4" id="rate_4">
                </label>
                <label for="rate_5">
                    <input type="radio" name="rate" value="5" id="rate_5">
                </label>
            </div>
            <div class="votes">Votes: 23</div>
        </div>
    </div>
@endif
