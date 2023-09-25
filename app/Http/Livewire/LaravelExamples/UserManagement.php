<?php

namespace App\Http\Livewire\LaravelExamples;

use Livewire\Component;
use App\Models\User;

class UserManagement extends Component
{
    public function render()
    {

        $users = User::all();

        return view('livewire.laravel-examples.user-management', compact('users'));
    }
}
