<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAliasRequest;
use App\Http\Requests\StoreHeroRequest;
use App\Models\Alias;
use App\Models\Alignment;
use App\Models\Hero;
use App\Models\Publisher;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index(Request $request)
    {
        $heroes = Hero::with('alignment')->get();

        if ($request->speed == 'asc') {
            $heroes = $heroes->sortBy('speed');
        } else if ($request->speed == 'desc') {
            $heroes = $heroes->sortByDesc('speed');
        }

        return view('welcome', compact('heroes'));
    }

    public function create()
    {
        $publishers = Publisher::all();
        $alignments = Alignment::all();

        return view('heroes.create', compact('publishers', 'alignments'));
    }

    public function store(Request $request, StoreHeroRequest $storeHeroRequest)
    {
        $validated = $storeHeroRequest->validated();

        $hero = Hero::create($validated);

        foreach ($request->aliases as $item) {

            $alias = new Alias($validated);
            $alias->name = $item['name'];
            $alias->hero_id = $hero->id;
            $alias->save();
        }

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $hero->addMediaFromRequest('cover')->toMediaCollection('covers');
        }

        return redirect()->route('heroes.index')->with('success', 'Hero successfully created.');
    }

    public function show(Hero $hero)
    {
        return view('heroes.show', compact('hero'));
    }

    public function destroy(Hero $hero)
    {
        $hero->delete();

        return redirect()->route('heroes.index')->with('success', 'Hero successfully deleted.');
    }
}
