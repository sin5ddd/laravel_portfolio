@extends('url._base')
@section('title','タイトル')
@section('contents')
	<article id="shortener-edit">
		<h1 style="text-align:center;">リンク修正</h1>
		<form action="/store" method="POST">
			@csrf
			<table style="margin : 1rem auto;">
				<tbody>
				<tr>
					<th>id</th>
					<td><input id="id" name="id" type="number" required readonly value="{{$url->id}}"></td>
				</tr>
				<tr>
					<th>識別名</th>
					<td><input type="text" id="name" name="name" required value="{{$url->name}}"></td>
				</tr>
				<tr>
					<th>転送先URL</th>
					<td><input id="orig_url" name="orig_url" type="text" required value="{{$url->orig_url}}">
					</td>
				</tr>
				<tr>
					<th colspan="2">UTM</th>
				</tr>
				<tr>
					<th>ソース</th>
					<td>
						<select name="utm_source" id="utm_source">
							<option value="cpc" @if ($url->utm_source=="cpc")selected @endif>Web広告</option>
							<option value="signage" @if ($url->utm_source=="signage")selected @endif>看板</option>
							<option value="email" @if ($url->utm_source=="email")selected @endif>メール</option>
							<option value="flyer" @if ($url->utm_source=="flyer")selected @endif>チラシ</option>
							<option value="youtube" @if ($url->utm_source=="youtube")selected @endif>YouTube動画内</option>
							<option value="place" @if ($url->utm_source=="place")selected @endif>Gビジネスプロフィール</option>
							<option
										value="none" @if ($url->utm_source=="none" || $url->utm_source=='')selected @endif>指定なし
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>メディア</th>
					<td>
						<input id="short_medium" name="utm_medium" type="text" value="{{$url->utm_medium}}">
					</td>
				</tr>
				<tr>
					<th>キャンペーン</th>
					<td>
						<input id="utm_campaign" name="utm_campaign" type="text" value="{{$url->utm_campaign}}">
					</td>
				</tr>
				<tr>
					<th>作成日</th>
					<td>{{$url->created_at}}</td>
				</tr>
				<tr>
					<th>更新日</th>
					<td>{{$url->updated_at}}</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;padding-top: 2rem;">
						<button class="update">更新</button>
					</td>
				</tr>
				</tbody>
			</table>
		</form>

		<hr>

		<table>
			<tr>
				<th colspan="3" style="max-width: 600px;">ショートURL</th>
			</tr>
			<tr>
				<td colspan="3" style="text-align:center;">
					<button class="normal copy_button"><i class="fa-regular fa-copy"></i> {{$url->short}}</button>
				</td>
			</tr>
			<tr>
				<th colspan="3" style="max-width: 600px;">展開URL</th>
			</tr>
			<tr>
				<td colspan="3" style="text-align:center;">
					<button class="normal copy_button"><i class="fa-regular fa-copy"></i> {{$url->real_url}}</button>
				</td>
			</tr>
			<tr>
				<th>JPG</th>
				<th>PNG</th>
				<th>SVG</th>
			</tr>
			<tr>
				<td>
					<img src="{{asset('storage/img/'.$url->shorten_url)}}.jpg" alt="jpg">
				</td>
				<td>
					<img src="{{asset('storage/img/'.$url->shorten_url)}}.png" alt="png">
				</td>
				<td>
					<img src="{{asset('storage/img/'.$url->shorten_url)}}.svg" alt="svg">
				</td>
			</tr>
		</table>
	</article>
	@if(session('message'))
		<nav id="flash-message" class="flash-message-{{session('type')}}">{{session('message')}}</nav>
	@endif
	<nav id="back-to-top" style="position: fixed; left: 1rem; top: 1rem;">
		<a href="/" style=" font-size: 200%;"><i class="fa-solid fa-arrow-left"></i></a>
	</nav>
	@vite(['resources/js/module/copy_short.js'])
@endsection