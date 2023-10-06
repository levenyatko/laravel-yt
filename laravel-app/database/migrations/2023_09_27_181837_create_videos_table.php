<?php

use App\Models\Video;
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
        $visibility_items = array_keys( Video::VISIBILITY );

        Schema::create('videos', function (Blueprint $table) use ($visibility_items) {
            $table->id();
            $table->unsignedBigInteger('channel_id');
            $table->string('uid');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('path')->nullable();
            $table->enum('visibility', $visibility_items)->default('private');
            $table->string('processed_file')->nullable();
            $table->string('processed_percentage')->nullable();
            $table->boolean('processed')->default(false);
            $table->boolean('allow_likes')->default(false);
            $table->boolean('allow_comments')->default(false);
            $table->timestamps();

            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
