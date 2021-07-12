@extends('vendor/duxphp/duxravel-installer/src/Views/layouts.master-update')

@section('title', trans('duxinstall::lang.updater.final.title'))
@section('container')
    <p class=" text-center">{{ session('message')['message'] }}</p>
    <div class="py-6 text-right">
        <a href="{{ url('/') }}" class="btn-blue">{{ trans('duxinstall::lang.updater.final.exit') }}</a>
    </div>
@stop
