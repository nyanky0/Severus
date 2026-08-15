<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tokopedia_sync_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('old_price_idr', 15, 2)->nullable();
            $table->decimal('new_price_idr', 15, 2)->nullable();
            $table->string('status'); // 'SUCCESS', 'FAILED', 'NO_CHANGE'
            $table->text('message')->nullable();
            $table->timestamp('synced_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tokopedia_sync_logs');
    }
};
