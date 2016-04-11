<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Administration - Medias
			@show
		</title>
		<meta name="keywords" content="your, awesome, keywords, here" />
		<meta name="author" content="Jon Doe" />
		<meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->		
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Javascripts
		================================================== -->
		<script src="{{ asset('assets/js/jquery-1.11.0.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/js/admin.js') }}"></script>
        
        <script>
            var base_url = "{{ URL::to('/') }}";
        </script>

	</head>

	<body style="min-width: 1px !important; overflow: hidden;">
		<!-- Container -->
		<div>

			<!-- Notifications -->
			@include('frontend/notifications')

			<!-- Content -->
			<ul class="nav nav-tabs" id="mediaTab" style="padding-top:10px; width: 100%">
			  <li {{ (Request::is('medias/upload') ? ' class="active"' : '') }}><a href="{{ URL::to('medias/upload?env='.$env) }}"><span class="glyphicon glyphicon-cloud-upload"></span> Tải tệp tin</a></li>
			  <li {{ (Request::is('medias/my') ? ' class="active"' : '') }}><a href="{{ URL::to('medias/my?env='.$env) }}"><span class="glyphicon glyphicon-user"></span> Thư viện của bạn</a></li>
			  <li {{ (Request::is('medias/index') ? ' class="active"' : '') }}><a href="{{ URL::to('medias/index?env='.$env) }}"><span class="glyphicon glyphicon-th"></span> Tất cả</a></li>
			</ul>
			<div style="padding-top: 15px;">
			    <!--Body content-->
				@yield('content')
			</div>
		</div>
	</body>
</html>
