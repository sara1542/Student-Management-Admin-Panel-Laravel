<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('courseID');
            $table->foreign('courseID')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->string('Name');
            $table->string('Description');
            $table->unsignedBigInteger('Max');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('items_courseID_foreign');
        $table->dropIndex('items_courseID_index');
        $table->dropColumn('courseID');
        Schema::dropIfExists('items');
    }
}
