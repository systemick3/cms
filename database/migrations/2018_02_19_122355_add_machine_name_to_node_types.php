<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMachineNameToNodeTypes extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('node_types', function (Blueprint $table) {
      $table->dropColumn('type');
      $table->string('machine_name', 255)->after('id');
      $table->string('display_name', 255)->after('machine_name');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('node_types', function (Blueprint $table) {
      $table->dropColumn('display_name');
      $table->dropColumn('machine_name');
      $table->string('type', 255)->nullable(false)->default('');
    });
  }
}
