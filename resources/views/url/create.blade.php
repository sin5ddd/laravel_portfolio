@extends('url._base')
@section('title','新規作成')
@section('contents')
	<article id="shortener-edit">
		<h1 style="text-align:center;">リンク新規作成</h1>
		<form action="/insert" method="POST">
			@csrf
			<table style="margin : 1rem auto;">
				<tbody>
				<tr>
					<th>id</th>
					<td><input id="id" name="id" type="number" required readonly placeholder="(自動)"></td>
				</tr>
				<tr>
					<th>識別名*</th>
					<td><input type="text" id="name" name="name" required></td>
				</tr>
				<tr>
					<th>転送先URL*</th>
					<td><input id="orig_url" name="orig_url" type="text" required>
					</td>
				</tr>
				<tr>
					<th colspan="2">UTM</th>
				</tr>
				<tr>
					<th>ソース</th>
					<td>
						<select name="utm_source" id="utm_source">
							<option value="cpc">Web広告</option>
							<option value="signage">看板</option>
							<option value="email">メール</option>
							<option value="flyer">チラシ</option>
							<option value="youtube">YouTube動画内</option>
							<option value="place">Gビジネスプロフィール</option>
							<option value="none" selected>指定なし</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>メディア</th>
					<td>
						<input id="short_medium" name="utm_medium" type="text">
					</td>
				</tr>
				<tr>
					<th>キャンペーン</th>
					<td>
						<input id="utm_campaign" name="utm_campaign" type="text">
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;padding-top: 2rem;">
						<button class="update">作成</button>
					</td>
				</tr>
				</tbody>
			</table>
		</form>

	</article>
	@vite(['resources/js/module/copy_short.js'])
@endsection