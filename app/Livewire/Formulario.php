<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Rule;
use App\Livewire\Forms\PostCreateForm;
use Illuminate\Mail\Mailables\Content;

class Formulario extends Component
{
    public $categories, $tags;

    public PostCreateForm $postCreate;

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
        $this->postCreate->validate();

        $post  = Post::create([
            $this->only('title', 'content','category_id')
        ]);

        $post->tags()->attach($this->postCreate->tags);

        $this->postCreate->reset();

        $this->posts = Post::all();
    }

    public function edit($postId)
    {
        $this->resetValidation();
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

        // dd(gettype($this->postEdit['tags']));
        $this->validate([
            'postEdit.title' =>  'required',
            'postEdit.content' => 'required',
            'postEdit.category_id' => 'required|exists:categories,id',
            'postEdit.tags' => 'required'
        ]);

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
