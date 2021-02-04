<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNicknameToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::table('users', function (Blueprint $table) {
    //         $table->string('nickname')->unique();
    //     });
    // }

    public function up(){
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname');
        });
        $rows = DB::table('users')->get(['id']);
        foreach ($rows as $row) {
            DB::table('users')->where('id', $row->id)->update(['nickname' => 'nn' . ((int)$row->id + 1)]);
        }
        Schema::table('users', function (Blueprint $table) {
            $table->unique('nickname');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['nickname']);
            $table->dropColumn('nickname');
        });
    }

}
