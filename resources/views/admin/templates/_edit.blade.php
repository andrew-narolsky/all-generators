@extends('admin.master')

@section('title', 'Edit template - AdminPanel')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5 text-right">
                    <ul class="breadcrumbs" style="color: #fff">
                        <li class="nav-home">
                            <a href="{{ route('admin') }}" style="color: #fff">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('templates.index') }}" style="color: #fff">{{ __('Templates') }}</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <span>{{ __('Edit template') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ __('Edit template') }}</div>
                            </div>
                            <div class="card-body">
                                @include('admin._messages')
                                <form action="{{ route('templates.update', $template->id) }}" method="POST" id="edit_template" data-template="{{ $template->id }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group @error('title') has-error @enderror">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Title') }}</label>
                                        <input type="text" class="form-control input-style" name="title" value="{{ $template->title }}">
                                        @error('title')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success btn-style mt-4">{{ __('Save') }}</button>
                                    </div>
                                </form>
                                <div class="form-group">
                                    <label class="input__label">{{ __('Blocks') }}</label>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body" id="block_list">
                                                    @if(!$template->blocks->count())
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
                                                                @foreach($template->blocks as $key => $block)
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
                                                </div>
                                            </div>
                                            <select class="form-control" name="block_id">
                                                <option value="0">{{ __('Select value...') }}</option>
                                                @foreach($blocks as $block)
                                                    <option value="{{ $block->id }}">{{ $block->title }}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-right">
                                                <button id="add_block" disabled class="btn btn-success btn-style mt-4">{{ __('Add block') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
