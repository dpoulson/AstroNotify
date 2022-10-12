<?php

namespace App\Http\Livewire;
use App\Models\User;

use Livewire\Component;

class RequirementsTable extends Component
{

    protected $listeners = ['delete'];
    
    public function render()
    {
        $requirements = auth()->user()->requirement;
        return view('livewire.requirements-table', compact('requirements'));
    }
}
