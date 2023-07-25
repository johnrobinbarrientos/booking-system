<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateUser extends Component
{    
    public $password;
    public $password_confirmation;
    public $visible = false;
    public $designTemplate = 'tailwind';

    public function render()
    {
        return view('livewire.create-user');
    }

    public function generatePassword(): Void
    {
        $lowercase = range('a', 'z');
        $uppercase = range('A', 'Z');
        $digits = range(0,9);
        $special = ['!', '@', '#', '$', '%', '^','&'];
        $chars = array_merge($lowercase, $uppercase, $digits, $special);
        $length = env('PASSWORD_LENGTH', 8);

        do{
            $password = array();

            for($i = 0; $i <= $length; $i++)
            {
                $int = rand(0, count($chars) - 1);
                array_push($password, $chars[$int]);
            }

        }while (empty(array_intersect($special, $password)));

        $this->setPasswords(implode('', $password));
    }

    public function setPasswords($value)
    {
        $this->password = $value;
        $this->password_confirmation = $value;
    }
}
