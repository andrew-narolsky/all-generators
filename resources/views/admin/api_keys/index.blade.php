@extends('admin.master')

@section('title', 'Settings - AdminPanel')

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
                            <span>{{ __('API Keys') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ __('API Keys') }}</div>
                            </div>
                            <div class="card-body">
                                @include('admin._messages')
                                <form action="{{ route('api-keys.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Paraphrasing tool API url') }}</label>
                                        <input type="text" class="form-control input-style" name="paraphrasing_url" value="{{ str_replace('_', ' ', env('PARAPHRASING_API_URL')) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Paraphrasing tool API key') }}</label>
                                        <input type="text" class="form-control input-style" name="paraphrasing_key" value="{{ str_replace('_', ' ', env('PARAPHRASING_API_KEY')) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Essay maker API url') }}</label>
                                        <input type="text" class="form-control input-style" name="essay_maker_url" value="{{ str_replace('_', ' ', env('ESSAY_MAKER_API_URL')) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Essay maker API key') }}</label>
                                        <input type="text" class="form-control input-style" name="essay_maker_key" value="{{ str_replace('_', ' ', env('ESSAY_MAKER_API_KEY')) }}">
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
