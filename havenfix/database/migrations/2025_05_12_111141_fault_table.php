<?php

use App\Models\User;
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
        Schema::create('faults', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('item');
            $table->string('image');
            $table->text('description');
            $table->string('block');
            $table->integer('level');
            $table->enum('status', ['Pending', 'In Process', 'Completed']);
            // $table->string('location');
            $table->timestamps();
            $table->softDeletes(); // Adds a nullable 'deleted_at' column

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faults');
    }
};
