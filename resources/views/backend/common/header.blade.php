<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>{{ $site->setting_title }} | Admin Panel</title>
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('icomoon/style.css') }}
	{{ HTML::style('admin/css/jquery.multiselect.css') }}
	{{ HTML::style('admin/css/style.css') }}

</head>
<body>
	<input type="hidden" id="base_url" value="{{ url('rt-admin/') }}">
	<input type="hidden" id="wbase_url" value="{{ url('/') }}">
	<header>
			<div class="top-bar">
				<nav class="navbar-nav">
					<ul>
						<div class="navbar-brand nav-item float-left">
							<span>{{ strtoupper($site->setting_title) }}</span>
						</div>
						<li class="nav-item float-right">
							<span class="icon-user"><i class="icon-angle-down"></i></span>
						</li>
						<ul class="inner-ul">
	                        <li><a href="{{ url('rt-admin/setting') }}"><i class="icon-gear"></i> Settings</a>
	                        </li>
	                        <li><a href="{{ url('rt-admin/change-password') }}"><i class="icon-lock"></i> Change Password</a>
	                        </li>
	                        <div class="divider"></div>
	                        <li><a href="{{ url('rt-admin/logout') }}"><i class="icon-sign-out"></i> Logout</a>
	                        </li>
	                    </ul>
					</ul>
				</nav>
			</div>
	</header>
	<div style="width:100%; overflow: hidden;">
	<div class="row">
		@include('backend.common.sidebar')
		<div class="col-sm-10">
			<div class="page-content">
