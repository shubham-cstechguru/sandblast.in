@php
	$site = DB::table('settings')->first();
@endphp

@if(session()->has('user_auth'))

	@php
		$profile = DB::table('users')->where('user_id', session('user_auth'))->first();
	@endphp

	@include('backend.common.header')
	@include('backend.inc.'.$page)
	@include('backend.common.footer')

@else

	@include('backend.login')

@endif