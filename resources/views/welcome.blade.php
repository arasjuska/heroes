@extends('layouts.app')

@section('title', 'Heroes List')

@section('content')
    <div class="p-8 bg-white rounded">
        <form action="{{ route('heroes.index') }}" method="get" class="mb-4">
            <label for="speed">{{ __('Sort By Speed:') }}</label>
            <select name="speed" class="border-2 py-1 rounded">
{{--                <option value="">{{ __('Default') }}</option>--}}
                <option value="asc">{{ __('Acs') }}</option>
                <option value="desc">{{ __('Desc') }}</option>
            </select>
            <button type="submit" class="bg-sky-600 text-white py-1 px-4 rounded">{{ __('Sort') }}</button>
        </form>
        <div class="grid md:grid-cols-4 gap-5">
            @foreach($heroes as $hero)
                <x-card>
                    <x-card.cover>
                        <x-slot name="image">
                            {{ $hero->getFirstMediaUrl('covers', 'sm') }}
                        </x-slot>
                        <x-slot name="alt">
                            {{ $hero->name }}
                        </x-slot>
                    </x-card.cover>

                    <x-card.body>
                        <a href="{{ route('heroes.show', $hero->id) }}">
                            {{ $hero->name }}
                        </a>
                    </x-card.body>

                    <x-card.footer>
                        <x-slot name="alignment">
                            {{ $hero->alignment->name }}
                        </x-slot>
                        <x-slot name="speed">
                            {{ __('Speed:') }}
                            {{ $hero->speed }}
                        </x-slot>
                    </x-card.footer>
                </x-card>
            @endforeach
        </div>
{{--        <div>--}}
{{--            {{ $heroes->links() }}--}}
{{--        </div>--}}
    </div>
@endsection
