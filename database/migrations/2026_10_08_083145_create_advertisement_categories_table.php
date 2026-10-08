<?php

use App\Models\Advertisement;
use App\Models\Category;
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
        Schema::create('advertisement_categories', function (Blueprint $table) {
            $table->foreignIdFor(Advertisement::class)->onDelete('cascade');
            $table->foreignIdFor(Category::class)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisement_categories');
    }
};
