<?php

use App\Enums\NewsStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('A news header');
            $table->string('slug')->comment('A news slug');
            $table->string('author', 191)->default('Админ');
            $table->enum('status', NewsStatus::all());
            $table->string('image', 255)->nullable();
            $table->text('text')->comment('A news text');
            $table->boolean('isPrivate')->default(false)->comment('A private flag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
