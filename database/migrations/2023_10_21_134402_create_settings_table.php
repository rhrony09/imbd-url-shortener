<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value')->nullable();
            $table->timestamps();
        });

        $data = [
            'site_name' => 'IMBD URL Shortener',
            'site_tagline' => 'Create short, memorable links in seconds — no account required.',
            'email' => 'info@imbdagency.com',
            'phone' => '+8801797242610',
            'site_primary_color' => '#ea1d22',
            'site_accent_color' => '#972126',
            'site_secondary_color' => '#FCE09B',
            'site_secondary_accent_color' => '#B2533E   ',
            'logo' => 'logo.png',
            'og_image' => 'og-image.jpg',
            'favicon' => 'favicon.png',
            'header_meta_tags' => '',
        ];

        foreach ($data as $key => $value) {
            DB::table('settings')->insert([
                'key' => $key,
                'value' => $value
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('settings');
    }
};
