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
        Schema::create('user_enquiry_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('product_id');
            $table->string('product_name');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->text('message')->nullable();
            $table->string('delete_status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_enquiry_forms');
    }
};
