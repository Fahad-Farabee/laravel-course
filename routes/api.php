<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/* Route::get("/test", function () {
    return ["name" => "Fahad Farabee", "subject" => "CSE"];
}); */

Route::get("/test", function () {
    return ["name" => "Fahad Farabee", "subject" => "SWE"];
});


Route::post('signup', [UserAuthController::class, 'signup']);
Route::post('login', [UserAuthController::class, 'login']);


Route::group(['middleware' => "auth:sanctum"], function () {
    //showing students.
    Route::get('students', [StudentController::class, 'list']);
    //adding students.
    Route::post('add-student', [StudentController::class, 'add_student']);
    //updating students.
    Route::put('update-student', [StudentController::class, 'update_student']);
    //deleting students.
    Route::delete('delete-student/{id}', [StudentController::class, 'delete_student']);
    //searching student.
    Route::get('search-student/{name}', [StudentController::class, 'search_student']);
    //resource controller.
    Route::resource('member', MemberController::class);
});
Route::post('login', [UserAuthController::class, 'login'])->name('login');
