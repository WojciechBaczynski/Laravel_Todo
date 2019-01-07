<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;
use Session;

class TodosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        $this->validate($request, [
            'todo' => 'required'
        ]);

        $todo = new Todo();
        $todo->user_id = Auth::user()->id;
        $todo->todo = $request->todo;
        $todo->save();

        Session::flash('success', 'Your task has been saved successfuly!');

        return redirect()->back();
    }

    public function edit($id){
        $todo = Todo::find($id);
        if($todo->user_id != Auth::id()){
            return redirect()->route('home')->with('warning', 'Unauthorized!');
        }

        return view('edit')->with('todo', $todo);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'todo' => 'required'
        ]);

        $todo = Todo::find($id);
        if($todo->user_id != Auth::id()){
            return redirect()->route('home')->with('warning', 'Unauthorized!');
        }
        $todo->todo = $request->todo;
        $todo->save();

        return redirect()->route('home')->with('success', 'Todo updated!');
    }

    public function delete($id){
        $todo = Todo::find($id);
        if($todo->user_id != Auth::id()){
            return redirect()->route('home')->with('warning', 'Unauthorized!');
        }
        $todo->delete();

        return redirect()->route('home')->with('success', 'Todo deleted!');
    }

}
