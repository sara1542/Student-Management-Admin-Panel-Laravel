<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('student');
            $table->foreign('student')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('course');
            $table->foreign('course')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('enrollment_student_foreign');
        $table->dropIndex('enrollment_student_index');
        $table->dropColumn('student');
        $table->dropForeign('enrollment_course_foreign');
        $table->dropIndex('enrollment_course_index');
        $table->dropColumn('course');
        Schema::dropIfExists('enrollment');
    }
}
