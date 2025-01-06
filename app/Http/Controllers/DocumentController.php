<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class DocumentController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $entity = 'doc';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("view {$this->entity}");
        return view("documentation.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create {$this->entity}");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create {$this->entity}");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize("edit {$this->entity}");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize("edit {$this->entity}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize("destroy {$this->entity}");
    }
}
