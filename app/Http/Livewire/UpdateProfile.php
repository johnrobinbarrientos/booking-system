<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UpdateProfile extends Component
{
    public $name;
    public $email;
    public $successMessage;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
    ];

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function render()
    {
        return view('livewire.update-profile');
    }

    public function updateProfile()
    {

        $this->validate();

        auth()->user()->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        //$this->successMessage = "Profile saved successfully!";
        return redirect('account')->with('status', 'Profile Updated');
    }

    public function removeSuccessMessage()
    {
        $this->successMessage = null;
    }
}
