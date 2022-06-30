<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $request->validate([
            'height' => 'integer|between:0,100',
        ]);

        $hero = new Hero([
            'name' => $request->name,
            'height' => $request->height,
            'weight' => $request->weight,
            'intelligence' => $request->intelligence,
            'strength' => $request->strength,
            'speed' => $request->speed,
            'durability' => $request->durability,
            'power' => $request->power,
            'combat' => $request->combat,
            'publisher_id' => $request->publisher,
            'alignment_id' => $request->alignment,
        ]);

        if ($request->hasFile('cover')) {
            $hero->addMediaFromRequest('cover')->toMediaCollection('covers');
        }

        $hero->save();

        foreach ($request->aliases as $item) {
            $alias = new Alias();
            $alias->name = $item['name'];
            $alias->hero_id = $hero->id;
            $alias->save();
        }

        return redirect()->route('heroes.index');
    }

    public function show(Hero $hero)
    {
        return view('heroes.show', compact('hero'));
    }

    public function destroy(Hero $hero)
    {
        $hero->delete();

        return redirect()->route('heroes.index');
    }
}
