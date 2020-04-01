<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{   
    // yêu cầu người dùng đã xác thực
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }
}
