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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('uuid')->unique();
            $table->string('code')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->string('currency', 3)->default('ARS'); // <-- si querés manejar varias monedas
            $table->foreignId('province_id')->constrained()->onDelete('restrict');
            $table->foreignId('city_id')->constrained()->onDelete('restrict');
            $table->foreignId('neighborhood_id')->constrained()->onDelete('restrict');
            $table->string('address');
            $table->foreignId('property_type_id')->constrained()->onDelete('restrict');
            $table->foreignId('property_operation_type_id')->constrained()->onDelete('restrict');
            $table->foreignId('property_status_id')->constrained()->onDelete('restrict');
            $table->unsignedTinyInteger('rooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();


            $table->decimal('surface', 8, 2)->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_published')->default(true); // <-- estado publicación
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
