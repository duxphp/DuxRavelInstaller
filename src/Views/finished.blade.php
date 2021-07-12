@extends('vendor/duxphp/duxravel-installer/src/Views/layouts.master')

@section('template_title')
    {{ trans('duxinstall::lang.final.templateTitle') }}
@endsection

@section('title')
    {{ trans('duxinstall::lang.final.title') }}
@endsection

@section('container')

	@if(session('message')['dbOutputLog'])
		<p class="py-4 text-gray-500 text-base"><strong><small>{{ trans('duxinstall::lang.final.migration') }}</small></strong></p>
		<pre class="rounded bg-gray-800 text-white max-h-60 overflow-auto p-4"><code>{{ session('message')['dbOutputLog'] }}</code></pre>
	@endif

	<p class="py-4 text-gray-500 text-base"><strong><small>{{ trans('duxinstall::lang.final.console') }}</small></strong></p>
	<pre class="rounded bg-gray-800 text-white max-h-60 overflow-auto p-4"><code>{{ $finalMessages }}</code></pre>

	<p class="py-4 text-gray-500 text-base"><strong><small>{{ trans('duxinstall::lang.final.log') }}</small></strong></p>
	<pre class="rounded bg-gray-800 text-white max-h-60 overflow-auto p-4"><code>{{ $finalStatusMessage }}</code></pre>

	<p class="py-4 text-gray-500 text-base"><strong><small>{{ trans('duxinstall::lang.final.env') }}</small></strong></p>
	<pre class="rounded bg-gray-800 text-white max-h-60 overflow-auto p-4"><code>{{ $finalEnvFile }}</code></pre>

    <div class="text-right py-6">
        <a href="{{ url('/') }}" class="btn-blue">{{ trans('duxinstall::lang.final.exit') }}</a>
    </div>

@endsection
