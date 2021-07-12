@extends('vendor/duxphp/duxravel-installer/src/Views/layouts.master-update')

@section('title', trans('duxinstall::lang.updater.welcome.title'))
@section('container')
    <p class="text-center">
    	{{ trans('duxinstall::lang.updater.welcome.message') }}
    </p>
    <div class="py-6 text-right">
        <a href="{{ route('LaravelUpdater::overview') }}" class="btn-blue">{{ trans('duxinstall::lang.next') }}</a>
    </div>
@stop
