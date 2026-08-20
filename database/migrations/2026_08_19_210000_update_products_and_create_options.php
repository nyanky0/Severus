<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add new spec columns: Tip & Ferrule
        Schema::table('products', function (Blueprint $table) {
            $table->string('tip')->nullable()->after('weight_oz');
            $table->string('ferrule')->nullable()->after('tip');
        });

        // Remove removed columns
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['deflection_grade', 'chalk_friction', 'stock']);
        });

        // Create product_options table
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('title_en');          // e.g. "Tip Diameter", "Joint Type"
            $table->string('title_id');
            $table->string('option_en');         // e.g. "12.5mm Pro Taper", "Uni-Lock"
            $table->string('option_id');
            $table->decimal('price', 15, 2)->default(0); // additional price override
            $table->text('description_en')->nullable();
            $table->text('description_id')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('deflection_grade')->nullable();
            $table->string('chalk_friction')->nullable();
            $table->integer('stock')->default(10);
            $table->dropColumn(['tip', 'ferrule']);
        });

        Schema::dropIfExists('product_options');
    }
};
