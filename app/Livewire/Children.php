<?php

namespace App\Livewire;

use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Children extends Component
{
    //actualizar en tiempo real desde ambos componentes
    #[Modelable]
    public $name;
    public function render()
    {
        return view('livewire.children');
    }
}
