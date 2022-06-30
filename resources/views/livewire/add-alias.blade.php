<div class="border-y py-2 my-2">
    <label for="alias">{{ __('Alias') }}</label>
    @foreach ($aliases as $index => $alias)
        <div class="space-y-2">
            <input type="text"
                   name="aliases[{{$index}}][name]"
                   class="h-10 border mt-1 rounded px-4 bg-gray-50 mr-2"
                   wire:model="aliases.{{$index}}.name"/>

            <a href="#"
               wire:click.prevent="removeAlias({{$index}})"
               class="bg-gray-100 hover:bg-gray-200 py-2 px-4 rounded">
                {{ __('Delete') }}
            </a>
        </div>
    @endforeach

    <div class="mt-2">
        <button wire:click.prevent="addAlias"
                class="bg-gray-100 hover:bg-gray-200 py-2 px-4 rounded">
            {{ __('Add Another Alias') }}
        </button>
    </div>
</div>
