@extends('admin.master')

@section('title', 'Edit page - AdminPanel')

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
                            <a href="{{ route('pages.index') }}" style="color: #fff">{{ __('Pages') }}</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <span>{{ __('Edit page') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ __('Edit page') }}</div>
                                <a href="{{ route('templates.edit', $page->template_id) }}" class="btn btn-success">
                                    <i class="fas fa-pen"></i>
                                    {{ __(' Edit template') }}
                                </a>
                            </div>
                            <div class="card-body">
                                @include('admin._messages')
                                <form action="{{ route('pages.update', $page->id) }}" method="POST" id="edit_page">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group @error('title') has-error @enderror">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Title') }}</label>
                                        <input type="text" class="form-control input-style" name="title" value="{{ $page->title }}">
                                        @error('title')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('title') has-error @enderror">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Slug') }}</label>
                                        <input type="text" class="form-control input-style" name="slug" value="{{ $page->slug }}">
                                        @error('slug')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('count_votes') has-error @enderror">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Count votes') }}</label>
                                        <input type="text" class="form-control input-style" name="count_votes" value="{{ $page->count_votes }}">
                                        @error('count_votes')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('stars') has-error @enderror">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Stars') }}</label>
                                        <input type="text" class="form-control input-style" name="stars" value="{{ $page->stars }}">
                                        @error('stars')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">{{ __('Template select') }}</label>
                                        <select class="form-control" name="template_id">
                                            <option value="0">Select value...</option>
                                            @foreach($templates as $template)
                                                <option value="{{ $template->id }}" @if($template->id == $page->template_id) {{ 'selected' }} @endif>{{ $template->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @include('admin.pages._templates')
                                    <div class="form-group">
                                        <label class="input__label">{{ __('Seo Title') }}</label>
                                        <input type="text" class="form-control input-style" name="seo_title" value="{{ $page->seo_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="input__label">{{ __('Seo Description') }}</label>
                                        <input type="text" class="form-control input-style" name="seo_description" value="{{ $page->seo_description }}">
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success btn-style mt-4">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
