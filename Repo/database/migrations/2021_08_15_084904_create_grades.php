<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('studentID');
            $table->foreign('studentID')->references('student')->on('enrollment')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('courseID');
            $table->foreign('courseID')->references('course')->on('enrollment')->onDelete('cascade')->onUpdate('cascade');
            $table->string('Name');
            $table->unsignedBigInteger('Value');
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
        $table->dropForeign('grades_studentID_foreign');
        $table->dropIndex('grades_studentID_index');
        $table->dropColumn('studentID');
        $table->dropForeign('grades_courseID_foreign');
        $table->dropIndex('grades_courseID_index');
        $table->dropColumn('courseID');
        Schema::dropIfExists('grades');
    }
}
