<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('property_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('ip_address', 45);
            $table->timestamps();
            $table->unique(['property_id', 'ip_address']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('property_visits');
    }
};
