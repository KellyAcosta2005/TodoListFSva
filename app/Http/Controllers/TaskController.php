<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Manager;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('tasks.index', ['tasks' => Task::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
{
    $managers = Manager::all();

    return view('tasks.create', compact('managers'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        Task::create($request->validated());

        return to_route('tasks.index')->with('success', 'Tarea creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        $managers = Manager::all();
        return view('tasks.edit', compact('task', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return to_route('tasks.index')->with('success', 'Tarea actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return to_route('tasks.index')->with('success', 'Tarea eliminada');
    }
}

