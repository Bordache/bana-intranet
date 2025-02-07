<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;
use App\Helpers\LogHelper;
use App\Models\Domain;

class RankController extends Controller
{

    /* protected $entity = 'rank'; */

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $this->authorize("view {$this->entity}"); */
        /* return view("personnel.ranks.index"); */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       /*  $this->authorize("create {$this->entity}"); */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* $this->authorize("create {$this->entity}"); */
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
        /* $this->authorize("edit {$this->entity}"); */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /* $this->authorize("edit {$this->entity}"); */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /* $this->authorize("destroy {$this->entity}"); */
    }
}
