<?php

namespace App\Http\Livewire\Workers;

use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;

class Workers extends Component
{
    use WithPagination;

    public $search;
    public $deleteWorkers = '';

    public function mount()
    {
        $this->search = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $workers = Worker::where('name','like','%' . $this->search . '%')
        ->orWhere( 'contact_number','like','%' . $this->search . '%')
        ->orderBy('id', 'DESC')
        ->paginate(10); 

        return view('livewire.workers.workers', ['workers' => $workers]);
    }

    public function deleteWorker($worker_id)
    {
        Worker::find($worker_id)->delete();
        return redirect()->route('workers.index')->with('success', 'Worker successfully deleted.');
    }
}
