<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
	@include('includes.header')
    @include('includes.user_bar')
	
	<div class="page_width center">
        @yield('content')
	</div>

	@include('includes.footer')
</body>
</html>