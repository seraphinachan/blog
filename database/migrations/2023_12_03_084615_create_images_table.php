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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('name');
            $table->string('extension');
            $
=======
            $table->string('extension');
            $table->string('path');

            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_id');
            
>>>>>>> fb8e399f59bfec42621b050bf4500d4eaa430112
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
