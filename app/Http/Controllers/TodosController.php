<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Todo as TodoResource;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //fetch all todos
      $todos = Todo::orderBy('created_at', 'desc')->paginate(5);
      //return the collection of todo items as a resource
      return TodoResource::collection($todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $todo = $request->isMethod("put") ? Todo::findOrFail($request->todo_id) : new Todo;
        //$todo->id = $request->input("todo_id");
        $todo->title = $request->input("title");
        $todo->body = $request->input("body");
          if($todo->save()){
              return new TodoResource($todo);
          }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //fetch a single todo item
      $todo = Todo::findOrFail($id);
      //return the collection of todo item as a resource
      return new TodoResource  ($todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $todo = Todo::findOrFail($id);

          if($todo->delete()){
              return new TodoResource($todo);
          }
    }
}
