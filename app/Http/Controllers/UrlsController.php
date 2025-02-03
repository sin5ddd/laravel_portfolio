<?php
	
	namespace App\Http\Controllers;
	
	use App\Models\Url;
	use Illuminate\View\View;
	use Illuminate\Http\Request;
	use chillerlan\QRCode\QRCode;
	use chillerlan\QRCode\QROptions;
	use chillerlan\QRCode\Common\EccLevel;
	use Barryvdh\Debugbar\Facades\Debugbar;
	use chillerlan\QRCode\Output\QRGdImagePNG;
	use chillerlan\QRCode\Output\QRGdImageJPEG;
	use function PHPUnit\Framework\fileExists;
	
	class UrlsController extends Controller {
		public function index() {
			$urls = Url::all();
			for ($i = 0; $i < sizeof($urls); $i++) {
				$urls[0]->fullpath = env('APP_URL') .'/'. $urls[$i]->shorten_url;
			}
			return view('url.index', ["urls"=>$urls]);
		}
		
		public function create() { }
		
		public function store(Request $request) {
			$url = new Url();
			
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
			$url['created_at'] = \DateTime::createFromFormat('Y-m-d H:i:s', $url['created_at']);
			$url['updated_at'] = \DateTime::createFromFormat('Y-m-d H:i:s', $url['updated_at']);
			
			return view('url.show', [
				'url' => $url,
			]);
		}
		
		private function bake_real_url($url): string {
			$ret     = $url->orig_url;
			$tmp_arr = [];
			if ($url->utm_source !== '' && $url->utm_source !== 'none') {
				$tmp_arr[] = 'utm_source=' . $url->utm_source;
			}
			if ($url->utm_medium !== '') {
				$tmp_arr[] = 'utm_medium=' . $url->utm_medium;
			}
			if ($url->utm_campaign !== '') {
				$tmp_arr[] = 'utm_campaign=' . $url->utm_campaign;
			}
			if ($url->utm_term !== '') {
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
			$qr_root = __DIR__ . '/../../../public/img/';
			$hash = $url_obj->shorten_url;
			if(!file_exists(__DIR__.'/../../../public')) {
				mkdir(__DIR__.'/../../../public');
			}
			if (!file_exists($qr_root)) {
				mkdir($qr_root, 0777, true);
			}
			// dd(fileExists($qr_root));
			if (!file_exists($qr_root . $url_obj->shorten_url . '.svg')) {
				
				
				$option           = new QROptions();
				$option->eccLevel = EccLevel::L;
				$option->scale    = 20;
				$option->version  = 2;
				
				$enc_url = env('APP_URL') . "/hash";
				
				$img = new QRCode($option);
				$img->render($enc_url, "$qr_root$hash.svg");
				
				$option->outputInterface = QRGdImageJPEG::class;
				new QRCode($option)->render($enc_url,"$qr_root$hash.jpg");
				$option->outputInterface = QRGdImagePNG::class;
				new QRCode($option)->render($enc_url,"$qr_root$hash.png");
			}
		}
	}
