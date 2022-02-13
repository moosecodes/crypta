<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputStringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_strings', function (Blueprint $table) {
            $table->id();
            $table->string('cipher', 30);
            $table->string('algorithm', 30);
            $table->text('original_text');
            $table->text('encrypted_text');
            $table->string('iv_base64')->nullable();
            $table->string('passphrase_base64')->nullable();
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
        Schema::dropIfExists('input_strings');
    }
}
