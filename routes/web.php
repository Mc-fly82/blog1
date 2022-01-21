<?php

use App\Models\Todo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $todos = Todo::all();
    return view('welcome')->with("todos", $todos);
});


Route::post('todos/create', function () {
    Todo::create([
        "tache" => request()->tache,
        "status" => "todo",
    ]);

    $todos = Todo::all();
    return back()->with("todos", $todos);

})->name("todos.create");

Route::post('todos/update', function () {

    $todo = Todo::where("id", request()->id);

    $todo->update([
        "tache" => request()->tache,
    ]);

    $todos = Todo::all();

    return back()->with("todos", $todos);
})
     ->name("todos.update");

Route::post('todos/delete', function () {

    $todo = Todo::where("id", request()->id);

    $todo->delete();

    $todos = Todo::all();

    return view('welcome')->with("todos", $todos);
})
     ->name("todos.update");
