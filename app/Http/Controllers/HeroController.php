<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHeroRequest;
use App\Models\Alias;
use App\Models\Alignment;
use App\Models\Hero;
use App\Models\Publisher;
use App\Services\ApiUrl;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index(Request $request)
    {
        $heroes = Hero::with('alignment', 'media')->paginate(10);

        if ($request->speed == 'asc') {
            $heroes = $heroes->sortBy('speed', SORT_STRING)->perPage();
            $heroes->values()->all();
        } else if ($request->speed == 'desc') {
            $heroes = $heroes->orderBy('speed', 'desc')->cursorPaginate(15);
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

    public function storeApiHero(ApiUrl $apiUrl)
    {
        $response = $apiUrl->get('/all.json');

        if ($response->successful()) {

            $apiHeroes = collect(json_decode($response->body()));

            foreach ($apiHeroes as $apiHero) {

                if ($apiHero->biography->publisher) {
                    $publisher = Publisher::firstOrCreate(['name' => $apiHero->biography->publisher]);
                }

                if ($apiHero->biography->alignment === 'good') {
                    $alignment = Alignment::where('name', 'Good')->first();
                } else {
                    $alignment = Alignment::where('name', 'Bad')->first();
                }

                $hero = new Hero();
                $hero->name = $apiHero->name;
                $hero->is_local = false;
                $hero->height = $hero->getNumber($apiHero->appearance->height[1]);
                $hero->weight = $hero->getNumber($apiHero->appearance->weight[1]);
                $hero->intelligence = $apiHero->powerstats->intelligence;
                $hero->strength = $apiHero->powerstats->strength;
                $hero->speed = $apiHero->powerstats->speed;
                $hero->durability = $apiHero->powerstats->durability;
                $hero->power = $apiHero->powerstats->power;
                $hero->combat = $apiHero->powerstats->combat;
                $hero->publisher_id = $publisher->id;
                $hero->alignment_id = $alignment->id;

                if ($apiHero->images->lg) {
                    $hero->addMediaFromUrl($apiHero->images->lg)->toMediaCollection('covers');
                }

                $hero->save();

                if ($apiHero->biography->aliases) {
                    foreach ($apiHero->biography->aliases as $item) {
                        $alias = new Alias();
                        $alias->name = $item;
                        $alias->hero_id = $hero->id;
                        $alias->save();
                    }
                }
            }
        }

        return redirect()->route('heroes.index');
    }
}
