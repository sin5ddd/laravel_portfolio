@extends('url._base')
@section('title', 'URL短縮＆QR生成')
@section('contents')
	@vite(['resources/js/module/copy_short.js'])
	<article id="shortener-index">
		<h1 style="text-align:center;">URL短縮＆QR生成</h1>

		<div>
			<table>
				<tr>
					<th>id</th>
					<td>識別名</td>
					<th>元リンク</th>
					<th>省略リンク</th>
					<th></th>
				</tr>
				@foreach($urls as $url)
					<tr>
						<td>
							<a href="/show/{{$url->id}}" class="text-blue-800 underline"><i
											class="fa-solid fa-pencil underline"></i>{{$url->id}}</a>
						</td>
						<td>{{$url->name}}</td>
						<td class="line-clamp-2">{{$url->orig_url}}</td>
						<td>
							<button id="id_{{$url->id}}" class="normal copy_button" value="{{$url->shorten_url}}">
								<i class="fa-regular fa-copy"></i>{{$url->shorten_url}}
							</button>
						</td>
						<td>
							<button class="del"><i class="fa-solid fa-delete-left"></i>削除</button>
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</article>
@endsection