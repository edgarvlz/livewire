<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Comments extends Component
{

    public $comments = [];

    #[On('post-created')]
    public function addComment($comment){
        array_unshift( $this->comments, $comment);
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
