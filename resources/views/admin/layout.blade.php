<!DOCTYPE html>
<html>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-153790314-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-153790314-1');
	</script>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<meta name="theme-color" content="#002f6c"/>
	<link href="{{ asset('css/global.css') }}?version={{ config('app.version') }}" rel="stylesheet">
	<link href="{{ asset('css/tinymce/skin.min.css') }}?version={{ config('app.version') }}" rel="stylesheet">
	<!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
	{{-- <link rel="stylesheet" href="{{ asset('materialicons/material-icons.css')}}"> --}}
	<title>خدمات رفاهی - @yield('title')</title>
	<style>
		.global-alerts .alert {
			border-right: 3px solid blue;
		}

		.global-alerts {
			border-top: 0px;
		}
		</style>
	</head>
	<body class="admin">
		@component('components.admin-navigation')@endcomponent
		@yield('content')

		@php
			$alerts = $alerts ?? session('alerts', []);
			$alert_count = 0;
    		foreach ($alerts as $alert_type) $alert_count += count($alert_type);
		@endphp
		@if($alert_count)
			<div class="global-alerts shadow">
				@foreach ($alerts as $alert_type => $alert_list)
					<div class="alert {{ $alert_type }}">
						<img src="{{ asset('images/danger.png') }}" alt="">
						<div class="alert-list">
							<i class="material-icons left pointer">close</i>
							<ul>
								@foreach ($alert_list as $alert)
									<li>{{ $alert }}</li>
								@endforeach
							</ul>
						</div>
					</div>
				@endforeach
			</div>
			<div class="global-alerts">
				@foreach ($alerts as $alert_type => $alert_list)
					<div class="alert {{ $alert_type }} pulse">
						<img src="{{ asset('images/'. $alert_type .'.png') }}" alt="">
						<div class="alert-list">
							<i class="material-icons left pointer">close</i>
							<ul>
								@foreach ($alert_list as $alert)
									<li>{{ $alert }}</li>
								@endforeach
							</ul>
						</div>
					</div>
				@endforeach
			</div>
			@php Session::forget('alerts') @endphp
		@endif
		<div id="jdatemodal" class="modal">
			<div class="header title">
				<span class="right padding-right pointer"><i class="material-icons white-text">chevron_right</i></span>
				<span class="left padding-left pointer"><i class="material-icons white-text">chevron_left</i></span>
				<span class='jdatemodal-month pointer' ></span>
				-
				<span class='jdatemodal-year pointer' ></span>
			</div>
			<div class="modal-contentx padding">

				<table>
					<thead>
						<tr>
							<th width="14.2%">ش</th>
							<th width="14.2%">ی</th>
							<th width="14.2%">د</th>
							<th width="14.2%">س</th>
							<th width="14.2%">چ</th>
							<th width="14.2%">پ</th>
							<th width="14.2%">ج</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="modal-list month">
				<ul id="jdatemodal-month"></ul>
			</div>
			<div class="modal-list year">
				<ul id="jdatemodal-year"></ul>
			</div>
		</div>
		<script src="{{ asset('js/app.js') }}?version={{ config('app.version') }}"></script>
		<script src="{{ asset('js/admin.js') }}?version={{ config('app.version') }}"></script>
		@yield('additional_script')
	</body>
</html>
