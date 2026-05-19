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
Schema::create('users', function (Blueprint $table) {
    $table->id();

    $table->string('name');

    $table->string('matric_no')
          ->nullable()
          ->unique();

    $table->string('email')
          ->nullable()
          ->unique();

    $table->timestamp('email_verified_at')
          ->nullable();

    $table->string('role')
          ->default('student');

    $table->longText('face_descriptor')
          ->nullable();

    $table->longText('face_image')
      ->nullable();
      
    $table->string('password');

    $table->rememberToken();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
