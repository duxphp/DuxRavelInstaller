@extends('vendor/duxphp/duxravel-installer/src/Views/layouts.master')

@section('template_title')
    {{ trans('duxinstall::lang.environment.menu.templateTitle') }}
@endsection

@section('title')
    {!! trans('duxinstall::lang.environment.menu.title') !!}
@endsection

@section('container')

    <p class="text-center">
        {!! trans('duxinstall::lang.environment.menu.desc') !!}
    </p>
    <div class="py-6 flex justify-center gap-4">
        <a href="{{ route('DuxravelInstaller::environmentClassic') }}" class="btn">
            {{ trans('duxinstall::lang.environment.menu.classic-button') }}
        </a>
        <a href="{{ route('DuxravelInstaller::environmentWizard') }}" class="btn-blue">
            {{ trans('duxinstall::lang.environment.menu.wizard-button') }}
        </a>
    </div>

@endsection
