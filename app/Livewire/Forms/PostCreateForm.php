<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class PostCreateForm extends Form
{
    #[Rule('require')]
    public $title;

    #[Rule('require')]
    public $content;

    #[Rule('require|exists:categories,id')]
    public $category_id = '';

    #[Rule('require|array')]
    public $tags = [];
}
