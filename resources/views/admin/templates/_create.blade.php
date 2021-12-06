@extends('admin.master')

@section('title', 'New template - AdminPanel')

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
                            <span>{{ __('New template') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ __('New template') }}</div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('templates.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group @error('title') has-error @enderror">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Title') }}</label>
                                        <input type="text" class="form-control input-style" name="title" value="{{ old('title') }}">
                                        @error('title')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
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
