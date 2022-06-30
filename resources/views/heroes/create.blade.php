@extends('layouts.app')

@section('title', __('Create New Hero'))

@section('content')

    <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
            <div class="text-gray-600">
                <p>Please fill out all the fields.</p>
                @if ($errors->any())
                    <div class="bg-rose-500 text-white p-4 my-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form action="{{ route('heroes.store') }}" method="post" class="lg:col-span-2"
                  enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-6">
                    <div class="md:col-span-3">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name"
                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                    </div>

                    <div class="md:col-span-3">
                        <label for="publisher_id">{{ __('Publisher') }}</label>
                        <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                            <select name="publisher_id"
                                    id="publisher_id"
                                    class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent">
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <label for="height">{{ __('Height') }}</label>
                        <input type="number" name="height" id="height"
                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                    </div>

                    <div class="md:col-span-3">
                        <label for="weight">{{ __('Weight') }}</label>
                        <input type="number" name="weight" id="weight"
                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                    </div>

                    <div class="md:col-span-6">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-6">
                            <div class="md:col-span-1">
                                <label for="intelligence">{{ __('Intelligence') }}</label>
                                <input type="number" name="intelligence" id="intelligence"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                            </div>

                            <div class="md:col-span-1">
                                <label for="strength">{{ __('Strength') }}</label>
                                <input type="number" name="strength" id="strength"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                            </div>

                            <div class="md:col-span-1">
                                <label for="speed">{{ __('Speed') }}</label>
                                <input type="number" name="speed" id="speed"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                            </div>

                            <div class="md:col-span-1">
                                <label for="durability">{{ __('Durability') }}</label>
                                <input type="number" name="durability" id="durability"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                            </div>

                            <div class="md:col-span-1">
                                <label for="power">{{ __('Power') }}</label>
                                <input type="number" name="power" id="power"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                            </div>

                            <div class="md:col-span-1">
                                <label for="combat">{{ __('Combat') }}</label>
                                <input type="number" name="combat" id="combat"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-6">
                        @livewire('add-alias')
                    </div>

                    <div class="md:col-span-3">
                        <label for="alignment_id">{{ __('Alignment') }}</label>
                        <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                            <select name="alignment_id"
                                    id="alignment_id"
                                    class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent">
                                @foreach($alignments as $alignment)
                                    <option value="{{ $alignment->id }}">{{ $alignment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <label for="cover">{{ __('Cover') }}</label>
                        <input type="file" name="cover" id="cover"
                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                    </div>

                    <div class="md:col-span-6 mt-4 text-right">
                        <div class="inline-flex items-end">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
