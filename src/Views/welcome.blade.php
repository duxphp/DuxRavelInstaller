@extends('vendor/duxphp/duxravel-installer/src/Views/layouts.master')

@section('template_title')
    {{ trans('duxinstall::lang.welcome.templateTitle') }}
@endsection

@section('title')
    {{ trans('duxinstall::lang.welcome.title') }}
@endsection

@section('container')
    <p class="text-l">
      {{ trans('duxinstall::lang.welcome.message') }}
    </p>
    <p class="text-right py-8">
      <a href="{{ route('DuxravelInstaller::requirements') }}" class="btn-blue">
        {{ trans('duxinstall::lang.welcome.next') }}
          <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
      </a>
    </p>
@endsection
