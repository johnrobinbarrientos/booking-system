<?php

namespace App\Http\Livewire\Workers;

use App\Models\Project;
use App\Models\Worker;
use Livewire\Component;

class WorkersForm extends Component
{

    public Worker $worker;

    protected $rules = [
        'worker.name' => 'required|min:6',
        'worker.contact_number' => 'required',
        'worker.email' => 'required|min:15',
        'worker.date_of_birth' => 'required|date',
        'worker.roles' => 'required|in:Operator,Hoseman,Extraman',
        'worker.project_id' => '',
        'worker.emergency_contact_name' => 'required',
        'worker.emergency_contact_number' => 'required',
    ];

    public function mount(Worker $worker)
    {
        $this->worker = $worker ?? new Worker();
    }

    public function render()
    {
        $projects = Project::all(); 
        return view('livewire.workers.workers-form', compact('projects'));
    }

    public function save()
    {
        $this->validate();
        
        $this->worker->save();

        return redirect()->route('workers.index')->with('status', 'Operation Successfull');
    }

    public function updated($propertyName) {
        
        $this->validateOnly($propertyName);
    }
}
