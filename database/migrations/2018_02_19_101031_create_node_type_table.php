<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodeTypeTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('node_types', function (Blueprint $table) {
      $table->increments('id');
      $table->string('type', 255)->nullable(false)->default('');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
  */
  public function down()
  {
    Schema::dropIfExists('node_types');
  }
}
