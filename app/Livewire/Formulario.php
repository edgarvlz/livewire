<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Rule;

class Formulario extends Component
{
    public $categories, $tags;

    // #[Rule('required')]
    // public $title;
    // #[Rule('required')]
    // public $content;
    // #[Rule('required|required|exists:categories,id')]
    // public $category_id = '';
    // #[Rule('required|array')]
    // public $selectedTags = [];

    public $postCreate = [
        'category_id' => '',
        'title' => '',
        'content' => '',
        'tags' => [],
    ];

    public $posts;

    public $postEditId = '';

    public $postEdit = [
        'category_id' => '',
        'title' => '',
        'content' => '',
        'tags' => [],
    ];

    public $open = false;


    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();

        $this->posts = Post::all();
    }

    public function save()
    {
        // #[Rule('required')]
        // $this->validate();
        /* $this->validate([
            'title' =>  'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'selectedTags' => 'required|array'
        ],[
            'title.required' =>  'El campo titulo es requerido',
        ],[
            'category_id' => 'categoria',
        ]); */

        // $post = Post::create([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        // ]);

        $post  = Post::create([
            'category_id' => $this->postCreate['category_id'],
            'title' => $this->postCreate['title'],
            'content' => $this->postCreate['content'],
        ]);

        $post->tags()->attach($this->postCreate['tags']);

        $this->reset(['postCreate']);

        $this->posts = Post::all();
        // dd([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        //     'tags' => $this->selectedTags,
        // ]);
    }

    public function edit($postId)
    {
        $this->open = true;

        $this->postEditId = $postId;

        $post = Post::find($postId);

        $this->postEdit['category_id'] = $post->category_id;
        $this->postEdit['title'] = $post->title;
        $this->postEdit['content'] = $post->content;

        $this->postEdit['tags'] = $post->tags->pluck('id');
    }

    public function update()
    {
        $post = Post::find($this->postEditId);

        $post->update([
            'category_id' => $this->postEdit['category_id'],
            'title' => $this->postEdit['title'],
            'content' => $this->postEdit['content'],
        ]);

        $post->tags()->sync($this->postEdit['tags']);

        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->posts = Post::all();
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);

        $post->delete();

        $this->posts = Post::all();
    }


    public function render()
    {
        return view('livewire.formulario');
    }

}
