<?php
	
	namespace App\Http\Controllers;
	
	use App\Models\Url;
	use Illuminate\Http\Request;
	use chillerlan\QRCode\QRCode;
	use chillerlan\QRCode\QROptions;
	use Illuminate\Support\Facades\File;
	use chillerlan\QRCode\Common\EccLevel;
	use Barryvdh\Debugbar\Facades\Debugbar;
	use Illuminate\Support\Facades\Redirect;
	use chillerlan\QRCode\Output\QROutputInterface;
	
	class UrlsController extends Controller {
		public function index() {
			$urls = Url::all();
			for ($i = 0; $i < sizeof($urls); $i++) {
				$urls[0]->fullpath = env('APP_URL') . '/' . $urls[$i]->shorten_url;
			}
			return view('url.index', ["urls" => $urls]);
		}
		
		public function create() { }
		
		public function store(Request $request) {
			$url = Url::where('id', $request->input("id"))
			          ->first()
			;
			// $url->id           = $request->input('id');
			$url->name         = $request->input('name');
			$url->orig_url     = $request->input('orig_url');
			$url->utm_source   = $request->input('utm_source');
			$url->utm_medium   = $request->input('utm_medium');
			$url->utm_campaign = $request->input('utm_campaign');
			$arr=[];
			if($url->update()){
				$arr['message']='更新しました';
				$arr['type']='info';
			}else{
				$arr['message']='更新失敗';
				$arr['type']='error';
			}
			
			return redirect('/show/' . $url->id)
			            ->with($arr)
			;
			
			// if ($url->update()) {
			// 	Redirect::to('/show/' . $request->input('id'),headers:['message'=>'更新しました']);
			// } else {
			// 	Redirect::to('/show/' . $request->input('id'),headers:['message'=>'更新失敗']);
			// }
			
		}
		
		public function show($id) {
			
			$model = Url::where('id', $id)
			            ->get()
			;
			$url   = $model->first();
			$this->bake_qr($url);
			// dd($model->toArray());
			$url['real_url']   = $this->bake_real_url($url);
			$url['short']      = $this->bake_short_url($url);
			$url['created_at'] = new \DateTime($url['created_at']);
			$url['updated_at'] = new \DateTime($url['updated_at']);
			// Debugbar::info($url);
			return view('url.show', [
				'url' => $url,
			]);
		}
		
		public function redirect($hash) {
			
			$url = Url::where('shorten_url', $hash)
			          ->first()
			;
			if (!$url) {
				Redirect::to('404');
				exit;
			}
			// トラッキングなどの処理を挟む
			Redirect::to($url->orig_url)
			        ->send()
			;
		}
		
		private function bake_real_url($url): string {
			Debugbar::info($url);
			$ret     = $url->orig_url;
			$tmp_arr = [];
			if ($url->utm_source !== null && $url->utm_source !== 'none') {
				$tmp_arr[] = 'utm_source=' . $url->utm_source;
			}
			if ($url->utm_medium !== null && $url->utm_medium !== '') {
				$tmp_arr[] = 'utm_medium=' . $url->utm_medium;
			}
			if ($url->utm_campaign !== null && $url->utm_campaign !== '') {
				$tmp_arr[] = 'utm_campaign=' . $url->utm_campaign;
			}
			if ($url->utm_term !== null && $url->utm_term !== '') {
				$tmp_arr[] = 'utm_term=' . $url->utm_term;
			}
			if (sizeof($tmp_arr) > 0) {
				$ret .= '?' . implode('&', $tmp_arr);
			}
			return $ret;
		}
		
		private function bake_short_url($url): string {
			$ret = env('APP_URL') . '/';
			$ret .= $url->shorten_url;
			return $ret;
		}
		
		private function bake_qr(Url $url_obj) {
			$hash     = $url_obj->shorten_url;
			$base_url = 'storage/img/';
			if (!File::exists($base_url . $hash . '.svg')) {
				$option           = new QROptions();
				$option->eccLevel = EccLevel::L;
				$option->scale    = 20;
				$option->version  = 2;
				
				$enc_url   = env('APP_URL') . "/$hash";
				$file_root = __DIR__ . "/../../../public/storage/img/";
				$img       = new QRCode($option);
				$img->render($enc_url, $file_root . $hash . '.svg');
				
				$option->outputType = QROutputInterface::GDIMAGE_JPG;
				$img                = new QRCode($option);
				$img->render($enc_url, $file_root . $hash . '.jpg');
				$option->outputType = QROutputInterface::GDIMAGE_PNG;
				$img                = new QRCode($option);
				$img->render($enc_url, $file_root . $hash . '.png');
				
			}
		}
	}
