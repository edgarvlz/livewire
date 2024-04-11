<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class CreatePost extends Component
{
    public $title, $user;

    public function mount($user){
        $this->user = User::find(1);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
