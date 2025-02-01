<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta
				name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
	@vite('resources/css/app.css')
	<title>Document</title>
</head>
<body>

<div class="card-container">
	<i class="fa-regular fa-comments text-3xl shrink-0"></i>
	<div class="">
		<div class="text-xl font-middle text-black dark:text-white">新着メッセージ</div>
		<p class="text-gray-500 dark:text-gray-400 text-xs">メッセージタイトルをここに表示します</p>
	</div>
</div>

@vite('resources/js/app.js')
</body>
</html>