<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove old enum role column
            $table->dropColumn('role');

            // Add role_id column as foreign key
            $table->foreignId('role_id')->after('email')
                ->default(1)
                ->constrained('roles')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback changes: drop role_id and add role enum back

            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');

            $table->enum('role', ['user', 'admin', 'super admin']);
        });
    }
};
