@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-12 mb-5">
        <h1>@lang('lang.message') </h1>
        <h1>@lang('lang.greeting') </h1>
    </div>
</div>

<task-component></task-component>

@endsection
