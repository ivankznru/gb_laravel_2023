<?php

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
        Schema::create('request_infos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('A request_infos header');
            $table->string('slug')->comment('A request_infos slug');
            $table->text('text')->comment('A request_infos text');
            $table->string('phoneNumber')->comment('A request_infos phoneNumber');
            $table->string('email')->comment('A request_infos email');
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
        Schema::dropIfExists('request_infos');
    }
};
