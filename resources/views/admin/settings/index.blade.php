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
                            <span>{{ __('Settings') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ __('Settings') }}</div>
                            </div>
                            <div class="card-body">
                                @include('admin._messages')
                                <form action="{{ route('settings.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Email') }}</label>
                                        <input type="text" class="form-control input-style" name="email" value="{{ str_replace('_', ' ', env('ADMIN_EMAIL')) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Admin name') }}</label>
                                        <input type="text" class="form-control input-style" name="name" value="{{ str_replace('_', ' ', env('ADMIN_NAME')) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputTitle" class="input__label">{{ __('Main url') }}</label>
                                        <input type="text" class="form-control input-style" name="url" value="{{ str_replace('_', ' ', env('APP_MAIN_URL')) }}">
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
