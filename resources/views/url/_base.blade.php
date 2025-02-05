<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta
				name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	@section('head')
	@endsection
	@vite(['resources/css/app.css','resources/js/app.js'])
	<title>@yield('title')</title>

</head>
<body>
<nav id="top-menu" style="display: flex;">
	<h2>URL短縮＆QR生成</h2>
	<ul style="display: flex;">
		<li>
			@if (Request::is('index'))
				<span style="color:gray;">一覧</span>
			@else
				<a href="/index">一覧</a>
			@endif
		</li>
		<li>
			@if (Request::is('create'))
				<span style="color:gray;">新規作成</span>
			@else
				<a href="/create">新規作成</a>
			@endif
		</li>
	</ul>
</nav>
@yield('contents')

@include('parts.flash_message_box')
@include('parts.logout_button')
</body>
</html>