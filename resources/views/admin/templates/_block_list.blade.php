@if(!$blocks->count())
    <div class="card-sub">
        {{ __('Nothing found...') }}
    </div>
@else
    <table class="table mt-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col">{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($blocks as $key => $block)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $block->title }}</td>
                <td>
                    <a href="#" class="btn btn-danger btn-xs edit delete_item" data-id="{{ $block->pivot->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    <a href="#" class="btn btn-success btn-xs sortable_button">
                        <i class="fas fa-sort"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
