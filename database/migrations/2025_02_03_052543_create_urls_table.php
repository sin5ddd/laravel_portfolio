<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->id()->autoIncrement();
						$table->string('name',255);
						$table->string('orig_url');
						$table->string('shorten_url',16)->unique();
						$table->string('utm_source',255);
						$table->string('utm_media',255);
						$table->string('utm_campaign',255);
						$table->string('utm_term',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urls');
    }
};
