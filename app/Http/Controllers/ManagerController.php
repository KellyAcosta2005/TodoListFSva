<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerRequest;
use App\Models\Manager;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('managers.index', ['managers' => Manager::latest()->get()]);
    }

/**
 * Show the form for creating a new resource.
 */
public function create(): View
{
    return view('managers.create');
}

/**
 * Store a newly created resource in storage.
 */
public function store(ManagerRequest $request): RedirectResponse
{
    Manager::create($request->validated());

    return to_route('managers.index')->with('success', 'Responsable creado');
}

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {
        //
    }
}
