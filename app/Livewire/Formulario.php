<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Lazy;
use Livewire\WithFileUploads;
use App\Livewire\Forms\PostEditForm;
use App\Livewire\Forms\PostCreateForm;

#[Lazy]
class Formulario extends Component
{
    use WithFileUploads;

    public $categories, $tags;

    public PostCreateForm $postCreate;
    public PostEditForm $postEdit;

    public $posts;

    //ciclo de vida de un componente
    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::all();
    }

    public function save()
    {
        $this->postCreate->save();
        $this->posts = Post::all();

        $this->dispatch('post-created', 'Nuevo articulo creado.');
    }

    public function edit($postId)
    {
        $this->resetValidation();
        $this->postEdit->edit($postId);
    }

    public function update()
    {
        $this->postEdit->update();
        $this->posts = Post::all();
        $this->dispatch('post-created', 'Articulo actualizado.');
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);

        $post->delete();

        $this->posts = Post::all();

        $this->dispatch('post-created', 'Articulo eliminado.');
    }

    public function render()
    {
        return view('livewire.formulario');
    }

}
