<div>
    <h1 class="text-2xl font-semibold">
        Componente padre
    </h1>

    <x-input type="text" wire:model.live="name"/>

    <hr class="my-6">

    {{-- <div>
        @livewire('children', ['name' => $name])
    </div> --}}

    {{-- <div>
        @livewire('contador', [], key('contador-1'))

        @livewire('contador', [], key('contador-2'))

        @livewire('contador', [], key('contador-3'))

        @livewire('contador', [], key('contador-4'))

        @livewire('contador', [], key('contador-5'))

        @livewire('contador', [], key('contador-6'))
    </div> --}}

    {{-- <livewire:children wire:model="name"/> --}}
</div>