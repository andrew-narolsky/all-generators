@extends('admin.master')

@section('title', 'Conclusion: ' . $conclusion->title)

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ $conclusion->title }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content constants">
                        <span>{!! nl2br($conclusion->text) !!} </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
