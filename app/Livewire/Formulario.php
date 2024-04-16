<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;
use App\Models\Category;

class Formulario extends Component
{
    public $categories, $tags;

    public $category_id, $title, $content;
    public $selectedTags = [];


    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
