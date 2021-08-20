<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//  List courses for single student

Route::get('courses/{id}','App\Http\Controllers\CourseController@index');

//  List all courses

Route::get('courses','App\Http\Controllers\CourseController@index2');

//List Single Course
Route::get('course/{id}','App\Http\Controllers\CourseController@show');

//Create new Course
Route::post('course','App\Http\Controllers\CourseController@store');

//Update Course
Route::put('course','App\Http\Controllers\CourseController@store');

//Delete Course
Route::delete('course/{id}','App\Http\Controllers\CourseController@destroy');

//Search Courses

Route::get('Scourses/{valueToSearch}','App\Http\Controllers\CourseController@search');

//-----------------------------------

//List all students for single course
Route::get('students/{id}','App\Http\Controllers\StudentController@index');

//List all students not enrolled in a specefic course
Route::get('students2/{id}','App\Http\Controllers\StudentController@view');

//List students
Route::get('students','App\Http\Controllers\StudentController@index2');

//List Single student
Route::get('student/{id}','App\Http\Controllers\StudentController@show');

//Create new student
Route::post('student','App\Http\Controllers\StudentController@store');

//Update student
Route::put('student','App\Http\Controllers\StudentController@store');

//Delete student
Route::delete('student/{id}','App\Http\Controllers\StudentController@destroy');

//search students
Route::get('students/{selected}/{valueToSearch}','App\Http\Controllers\StudentController@search');

//enroll students in courses
Route::post('studentEnroll','App\Http\Controllers\EnrollmentController@Enroll');

//------- Levels

Route::get('levels/{id}','App\Http\Controllers\CourseController@getCoursesPerLevel');


//----- Programs


//List all programs
Route::get('programs','App\Http\Controllers\ProgramController@index');

//List Single Program
Route::get('program/{id}','App\Http\Controllers\ProgramController@show');

//Create new Program
Route::post('program','App\Http\Controllers\ProgramController@store');

//Update Program
Route::put('program','App\Http\Controllers\ProgramController@store');

//Delete Program
Route::delete('program/{id}','App\Http\Controllers\ProgramController@destroy');

//Search Programs

Route::get('programs/{selected}/{valueToSearch}','App\Http\Controllers\ProgramController@search');

//List all courses in a program
Route::get('programs/{Name}','App\Http\Controllers\CourseController@getCoursesPerProgram');

//-------------------------------------------------items
Route::get('Items/{courseIDD}','App\Http\Controllers\ItemController@show');

Route::post('item','App\Http\Controllers\ItemController@store');

//Update Program
Route::put('item','App\Http\Controllers\ItemController@store');

//Delete Program
Route::delete('item/{courseID}/{Name}','App\Http\Controllers\ItemController@destroy');
//-----------------------------------------------------
Route::get('grades/{id}/{courseid}','App\Http\Controllers\GradeController@show');

Route::put('grade','App\Http\Controllers\GradeController@store');

//fetch all grades for specific course id
Route::get('gradesPerCourse/{id}','App\Http\Controllers\GradeController@fetchGradesForCourse');
Route::get('gradesPerStudent/{id}','App\Http\Controllers\GradeController@fetchGradesForStudent');