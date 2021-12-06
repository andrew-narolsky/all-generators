@extends('admin.master')

@section('title', 'Templates - AdminPanel')

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
                            <span>{{ __('Templates') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ __('Templates') }}</div>
                                <a href="{{ route('templates.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ __(' New template') }}
                                </a>
                            </div>
                            <div class="card-body">
                                @if(!$templates->count())
                                    <div class="card-sub">
                                        {{ __('Nothing found...') }}
                                    </div>
                                @else
                                    <table class="table mt-3">
                                        <thead>
                                        <tr>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($templates as $template)
                                            <tr>
                                                <td>{{ $template->created_at->format('d.m.Y') }}</td>
                                                <td>{{ $template->title }}</td>
                                                <td>
                                                    <a href="{{ route('templates.edit', $template->id) }}" class="btn btn-primary  btn-xs edit page_block_delete">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto ml-auto mr-auto pagination">
                        {{ $templates->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
