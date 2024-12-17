<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUserListTable extends Migration
{
    public function up()
    {
        Schema::rename('user_list', 'user_lists');
    }

    public function down()
    {
        Schema::rename('user_lists', 'user_list');
    }
}
