@extends('admin.master')

@section('title', 'Conclusions generator - AdminPanel')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5"></div>
            </div>
            <div class="page-inner mt--5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ __('Conclusions generator') }}</div>
                            </div>
                            <div class="card-body">
                                @if(!$conclusions->count())
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
                                            @foreach($conclusions as $conclusion)
                                                <tr>
                                                    <td>{{$conclusion->created_at->format('d.m.Y')}}</td>
                                                    <td>{{$conclusion->title}}</td>
                                                    <td>
                                                        <a href="{{ route('admin.conclusion-generator.show', $conclusion->id) }}" class="btn btn-primary  btn-xs edit page_block_delete" id="edit"><i class="fa fa-eye"></i></a>
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
                        {{ $conclusions->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
