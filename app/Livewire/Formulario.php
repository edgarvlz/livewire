<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;
use App\Models\Category;
use App\Models\Post;

class Formulario extends Component
{
    public $categories, $tags;

    public $category_id = '', $title, $content;
    public $selectedTags = [];


    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function save()
    {
        // $post = Post::create([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        // ]);

        $post  = Post::create(
            $this->only('category_id', 'title', 'content')
        );

        $post->tags()->attach($this->selectedTags);

        $this->reset(['category_id', 'title', 'content', 'selectedTags']);

        // dd([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        //     'tags' => $this->selectedTags,
        // ]);
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
