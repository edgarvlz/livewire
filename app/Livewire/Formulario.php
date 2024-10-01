<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;
use Livewire\WithFileUploads;
use App\Livewire\Forms\PostEditForm;
use App\Livewire\Forms\PostCreateForm;

#[Lazy]
class Formulario extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $categories, $tags;

    public PostCreateForm $postCreate;
    public PostEditForm $postEdit;

    #[Url(as: 's')]
    public $search = '';

    //ciclo de vida de un componente
    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        // $this->posts = Post::paginate();
    }

    public function save()
    {
        $this->postCreate->save();
        // $this->posts = Post::all();
        $this->resetPage(pageName: 'pagePosts');
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
        // $this->posts = Post::all();
        $this->dispatch('post-created', 'Articulo actualizado.');
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);

        $post->delete();

        // $this->posts = Post::all();

        $this->dispatch('post-created', 'Articulo eliminado.');
    }

    // public function paginationView(){
    //     return 'vendor.livewire.simple-tailwind';
    // }

    public function render()
    {
        $posts = Post::orderBy('id', 'desc')
            ->when($this->search, function ($query){
                 $query->where('title', 'like', '%' . $this->search . '%');
            })
        ->paginate(5, pageName: 'pagePosts');

        return view('livewire.formulario', compact('posts'));
    }

}
