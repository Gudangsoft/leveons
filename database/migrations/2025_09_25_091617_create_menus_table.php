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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('status')->default('active'); // active, inactive
            $table->string('type')->default('page'); // page, link, dropdown
            $table->string('url')->nullable(); // for external links
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('level')->default(0); // 0=main, 1=sub, 2=sub-sub, etc
            $table->boolean('is_featured')->default(false);
            $table->json('settings')->nullable(); // additional settings
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
            $table->index(['parent_id', 'sort_order']);
            $table->index(['status', 'level']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
