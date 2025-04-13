<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProfilesExport implements FromView
{
    protected $profiles;
    protected $columns;

    public function __construct($profiles, $columns)
    {
        $this->profiles = $profiles;
        $this->columns = $columns;
    }

    public function view(): View
    {
        return view('personnel.profile.excel', [
            'profiles' => $this->profiles,
            'columns' => $this->columns
        ]);
    }
}

