<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		/**
		 * Run the migrations.
		 */
		public function up(): void {
			//
			Schema::table('urls', function (Blueprint $table) {
				$table->string('utm_source')->nullable()->change();
				$table->string('utm_campaign')->nullable()->change();
				$table->string('utm_media')->nullable()->change();
				$table->string('utm_term')->nullable()->change();
			});
		}
		
		/**
		 * Reverse the migrations.
		 */
		public function down(): void {
			//
		}
	};
