<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddRoleToUserListsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_lists', function (Blueprint $table) {
            // Add the 'role' column as an enum with specific values
            $table->enum('role', ['admin', 'user', 'mahasiswa'])->nullable();
        });

        // Set 'admin' role for the first id_userx
        DB::table('user_lists')->where('id_userx', 1)->update(['role' => 'admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_lists', function (Blueprint $table) {
            // Drop the 'role' column if it exists
            $table->dropColumn('role');
        });
    }
}
