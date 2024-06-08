<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('submissions')) {
            Schema::create('submissions', function (Blueprint $table) {
                $table->id();
                $table->string('name')->index();
                $table->string('email')->index();
                $table->text('message')->fullText();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
