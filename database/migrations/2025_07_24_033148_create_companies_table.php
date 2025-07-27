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
    Schema::create('companies', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // FK to users
        $table->string('name');
        $table->text('address');
        $table->string('industry');
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->timestamps();
        $table->softDeletes(); // deleted_at column
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
