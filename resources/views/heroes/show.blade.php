@extends('layouts.app')

@section('title', $hero->name)

@section('content')

    <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <div class="grid gap-4 gap-y-2 grid-cols-1 md:grid-cols-4">
            <div class="md:col-span-2">
                <div class="rounded-md overflow-hidden">
                    <img src="{{ $hero->getFirstMediaUrl('covers', 'lg') }}" alt="{{ $hero->name }}">
                </div>
            </div>

            <div class="md:col-span-2">
                <ul>
                    <li>{{ __('Intelligence: ') }}{{ $hero->intelligence }}</li>
                    <li>{{ __('Strength: ') }}{{ $hero->strength }}</li>
                    <li>{{ __('Speed: ') }}{{ $hero->speed }}</li>
                    <li>{{ __('Durability: ') }}{{ $hero->durability }}</li>
                    <li>{{ __('Power: ') }}{{ $hero->power }}</li>
                    <li>{{ __('Combat: ') }}{{ $hero->combat }}</li>
                </ul>
                <div class="border-t mt-2 pt-2">
                    <p>{{ __('Alignment: ') }}{{ $hero->alignment->name }}</p>
                </div>
            </div>

            <div class="md:col-span-4">
                <h3 class="text-xl">{{ __('Aliases') }}</h3>
                <ul class="italic">
                    @foreach($hero->aliases as $alias)
                        <li>{{ $alias->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="md:col-span-4">
                <h3 class="text-xl">{{ __('Other info') }}</h3>
                <ul class="italic">
                    <li>{{ __('Height: ') }}{{ $hero->converted_height }}</li>
                    <li>{{ __('Weight: ') }}{{ $hero->weight }}{{ ' kg' }}</li>
                </ul>
            </div>

            @if($hero->is_local)
                <div class="md:col-span-4 pt-2 border-t">
                    <form action="{{ route('heroes.destroy', $hero->id) }}"
                          method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="{{ __('Delete') }}"
                               class="bg-rose-600 hover:bg-rose-500 text-white py-2 px-4 rounded">
                    </form>
                </div>
            @endif
        </div>
    </div>

@endsection
