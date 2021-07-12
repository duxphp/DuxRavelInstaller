@extends('vendor/duxphp/duxravel-installer/src/Views/layouts.master-update')

@section('title', trans('duxinstall::lang.updater.welcome.title'))
@section('container')
    <p class=" text-center">{{ trans_choice('duxinstall::lang.updater.overview.message', $numberOfUpdatesPending, ['number' => $numberOfUpdatesPending]) }}</p>
    <div class="py-6 text-right">
        <a href="{{ route('LaravelUpdater::database') }}" class="btn-blue">{{ trans('duxinstall::lang.updater.overview.install_updates') }}</a>
    </div>
@stop
