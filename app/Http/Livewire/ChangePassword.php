<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{
    public $password;
    public $password_confirmation;

    public $errorMessage;
    public $successMessage;


    protected $rules = [
        'password' => 'required|min:8|max:12|confirmed'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.change-password');
    }

    public function changePassword()
    {
        $this->validate();
        auth()->user()->update([
            'password' => Hash::make($this->password)
        ]);

        $this->successMessage = "Password is updated successfully!";
        $this->resetForm();
    }

    public function resetForm(){
        $this->password =null;
        $this->password_confirmation =null;
    }

    public function removeSuccessMessage()
    {
        $this->successMessage = null;
    }
}
