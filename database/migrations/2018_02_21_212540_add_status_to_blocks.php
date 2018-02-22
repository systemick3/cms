<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToBlocks extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('blocks', function (Blueprint $table) {
      $table->tinyInteger('status')->nullable(false)->default(0)->after('body');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('blocks', function (Blueprint $table) {
      $table->dropColumn('status');
    });
  }
}
