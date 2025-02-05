<?php
	
	namespace App\Models;
	
	use League\Flysystem\Config;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	
	class Url extends Model {
		use HasFactory;
		
		protected $table    = 'urls';
		protected $primaryKey = 'id';
		protected $fillable = [
			'name',
			'orig_url',
			'shorten_url',
			'utm_source',
			'utm_media',
			'utm_campaign',
			'utm_term',
		];
		
		
		public static function generateShortenUrl($url):string{
			return substr(md5($url.time()), 0, 8);
		}
		
		
		
		//
	}
