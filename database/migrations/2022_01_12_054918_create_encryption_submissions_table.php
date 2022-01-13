<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncryptionSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encryption_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('cipher');
            $table->string('algorithm');
            $table->string('plainText');
            $table->string('encryptedText');
            $table->string('base64_passphrase');
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
        Schema::dropIfExists('encryption_submissions');
    }
}
