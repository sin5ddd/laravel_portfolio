@extends('url._base')
@section('title','タイトル')
@section('contents')
	<h1>リンク変更</h1>
	<form action="/edit/{{$url->id}}">
		@csrf
		<table class="table-auto">
			<tbody class="table-row-group flex-auto justify-between align-middle">
			<tr class="table-row">
				<th class="table-cell px-1.5">id</th>
				<td class="table-cell"><input id="id" name="id" type="number" required readonly value="{{$url->id}}"></td>
			</tr>
			<tr class="table-row">
				<th class="table-cell px-1.5">転送先URL</th>
				<td class="table-cell"><input id="orig_url" name="orig_url" type="text" required value="{{$url->orig_url}}">
				</td>
			</tr>
			<tr class="table-row">
				<th class="table-cell px-1.5">リンク文字列</th>
				<td class="table-cell">{{$url->short}}</td>
			</tr>
			<tr class="table-row">
				<th colspan="2" class="table-cell">UTM</th>
			</tr>
			<tr class="table-row">
				<th class="table-cell px-1.5">ソース</th>
				<td class="table-cell">
					<select name="utm_source" id="utm_source">
						<option value="cpc" @if ($url->utm_source=="cpc")selected @endif>Web広告</option>
						<option value="signage" @if ($url->utm_source=="signage")selected @endif>看板</option>
						<option value="email" @if ($url->utm_source=="email")selected @endif>メール</option>
						<option value="flyer" @if ($url->utm_source=="flyer")selected @endif>チラシ</option>
						<option value="youtube" @if ($url->utm_source=="youtube")selected @endif>YouTube動画内</option>
						<option value="place" @if ($url->utm_source=="place")selected @endif>Gビジネスプロフィール</option>
						<option value="none" @if ($url->utm_source=="none" || $url->utm_source=='')selected @endif>指定なし</option>
					</select>
				</td>
			</tr>
			<tr class="table-row">
				<th class="table-cell px-1.5">メディア</th>
				<td class="table-cell"><input
								id="short_medium" name="utm_medium" type="text" readonly value="{{$url->utm_medium}}"></td>
			</tr>
			<tr class="table-row">
				<th class="table-cell px-1.5">キャンペーン</th>
				<td class="table-cell"><input
								id="utm_campaign" name="utm_campaign" type="text" readonly value="{{$url->utm_campaign}}"></td>
			</tr>
			<tr class="table-row">
				<th class="table-cell px-1.5">作成日</th>
				<td class="table-cell">{{$url->created_at}}</td>
			</tr>
			<tr class="table-row">
				<th class="table-cell px-1.5">更新日</th>
				<td class="table-cell">{{$url->updated_at}}</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;padding-top: 2rem;">
					<button class="bg-amber-500">更新</button>
				</td>
			</tr>
			</tbody>
		</table>
	</form>
	<table>
		<tr>
			<th>リダイレクト先</th>
			<td colspan="2">{{$url->short}}</td>
		</tr>
		<tr>
			<th>JPG</th>
			<th>PNG</th>
			<th>SVG</th>
		</tr>
		<tr>
			<td>
				<img src="/img/{{$url->shorten_url}}.jpg" alt="">
			</td>
			<td>
				<img src="/img/{{$url->shorten_url}}.png" alt="">
			</td>
			<td>
				<img src="/img/{{$url->shorten_url}}.svg" alt="">
			</td>
		</tr>
	</table>
@endsection