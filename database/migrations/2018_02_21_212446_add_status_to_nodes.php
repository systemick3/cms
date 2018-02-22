<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToNodes extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('nodes', function (Blueprint $table) {
      $table->tinyInteger('status')->nullable(false)->default(0)->after('slug');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('nodes', function (Blueprint $table) {
      $table->dropColumn('status');
    });
  }
}
