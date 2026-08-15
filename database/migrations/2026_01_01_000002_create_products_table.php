<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name_en');
            $table->string('name_id');
            $table->string('slug')->unique();
            $table->text('description_en');
            $table->text('description_id');
            $table->decimal('price_idr', 15, 2);
            $table->decimal('price_usd', 10, 2)->default(0.00);
            $table->string('tokopedia_url')->default('https://www.tokopedia.com/severus');
            $table->string('image_path')->nullable();
            
            // Billiards & Accessories Specs
            $table->string('tip_size')->nullable(); // e.g. 12.5mm Pro Taper
            $table->string('joint_type')->nullable(); // e.g. Radial Joint / Uni-Loc
            $table->string('weight_oz')->nullable(); // e.g. 19.0 oz - 19.5 oz
            $table->string('deflection_grade')->nullable(); // e.g. Ultra Low Deflection
            $table->string('chalk_friction')->nullable(); // e.g. Nano High-Friction Matrix
            
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('stock')->default(10);
            $table->timestamp('last_tokopedia_synced_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
