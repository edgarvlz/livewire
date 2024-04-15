<div>
    {{-- <h1>{{ $name }}</h1> --}}

    <div>
        <x-input type="text" wire:model.live="name"/>

        <x-button wire:click='save()'>
            save
        </x-button>
    </div>

    {{$name}}
</div>
