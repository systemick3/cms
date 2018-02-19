<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nodes', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title', 255);
      $table->integer('file_id')->unsigned()->nullable();
      $table->text('body')->nullable(false);
      $table->integer('node_type_id')->unsigned();
      $table->timestamps();
      $table->foreign('file_id')->references('id')->on('files')->onDelete('set null');
      $table->foreign('node_type_id')->references('id')->on('node_types')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('nodes');
  }
}
