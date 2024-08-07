<div>

    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <form wire:submit='save'>
            <div class="mb-4">
                <x-label>
                    Nombre
                </x-label>
                <x-input class="w-full" wire:model='postCreate.title'/>

                <x-input-error for='postCreate.title'/>
            </div>

            <div class="mb-4">
                <x-label>
                    Contenido
                </x-label>
                <x-textarea class="w-full" wire:model='postCreate.content'></x-textarea>

                <x-input-error for='postCreate.content'/>
            </div>

            <div class="mb-4">
                <x-label>
                    Categoria
                </x-label>

                <x-select class="w-full" wire:model='postCreate.category_id' >
                    <option value="" selected disabled class="text-center"> -- Selecionar --</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </x-select>

                <x-input-error for='category_id'/>
            </div>

            <div class="mb-4">
                <x-label>
                    Etiquetas
                </x-label>

                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <label>
                                <x-checkbox wire:model='postCreate.tags' value="{{$tag->id}}"/>
                                {{$tag->name}}
                            </label>
                        </li>
                    @endforeach
                </ul>

                <x-input-error for='tags'/>
            </div>

            <div class="flex justify-end">
                <x-button>
                    Crear
                </x-button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow rounded-lg p-6 ">

        <ul class="list-disc list-inside space-y-2">
            @foreach ($posts as $post)
                <li class="flex justify-between" wire:key="post-{{$post->id}}">
                    {{$post->title}}

                    <div>
                        <x-button wire:click="edit({{$post->id}})">
                            Editar
                        </x-button>

                        <x-danger-button wire:click="destroy({{$post->id}})">
                            Eliminar
                        </x-danger-button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <form wire:submit='update'>
        <x-dialog-modal wire:model='open'>

            <x-slot name="title">
                Actualizar post
            </x-slot>

            <x-slot name="content">
                <div class="mb-4">
                    <x-label>
                        Nombre
                    </x-label>
                    <x-input class="w-full" wire:model='postEdit.title' />
                </div>

                <div class="mb-4">
                    <x-label>
                        Contenido
                    </x-label>
                    <x-textarea class="w-full" wire:model='postEdit.content' ></x-textarea>
                </div>

                <div class="mb-4">
                    <x-label>
                        Categoria
                    </x-label>

                    <x-select class="w-full" wire:model='postEdit.category_id' >
                        <option value="" selected disabled class="text-center"> -- Selecionar --</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </x-select>
                </div>

                <div class="mb-4">
                    <x-label>
                        Etiquetas
                    </x-label>

                    <ul>
                        @foreach ($tags as $tag)
                            <li>
                                <label>
                                    <x-checkbox wire:model='postEdit.tags' value="{{$tag->id}}"/>
                                    {{$tag->name}}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-danger-button class="mr-2" wire:click="$set('open', false)">
                        Cancelar
                    </x-danger-button>

                    <x-button>
                        Actualizar
                    </x-button>
                </div>
            </x-slot>

        </x-dialog-modal>
    </form>
</div>
