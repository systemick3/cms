<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('blocks', function (Blueprint $table) {
      $table->increments('id');
      $table->string('display_name', 255);
      $table->string('machine_name', 255);
      $table->string('title', 255)->nullable(false)->default('');
      $table->text('body')->nullable(true);
      $table->tinyInteger('in_code')->nullable(false)->default(0);
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
    Schema::dropIfExists('blocks');
  }
}
