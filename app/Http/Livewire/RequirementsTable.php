<?php

namespace App\Http\Livewire;
use App\Models\Requirement;

use Livewire\Component;

class RequirementsTable extends Component
{

    protected $listeners = ['delete'];

    public function render()
    {
        $requirements = auth()->user()->requirement;
        return view('livewire.requirements-table', compact('requirements'));
    }

    public function delete($id)
    {
        $requirement = Requirement::find($id);
        if ($requirement->user_id == auth()->user()->id) 
        {
            $requirement->delete();
        }
        $this->dispatchBrowserEvent('requirement-deleted');
    }
}
