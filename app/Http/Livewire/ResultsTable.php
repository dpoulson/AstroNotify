<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ResultsTable extends Component
{
    public function render()
    {
        $requirements = auth()->user()->requirement;
        return view('livewire.results-table', compact('requirements'));
    }
}
