<?php

namespace App\Jobs;

use App\Models\Alias;
use App\Models\Alignment;
use App\Models\Hero;
use App\Models\Publisher;
use App\Services\ApiUrl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetApiHeroJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ApiUrl $apiUrl)
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
    }
}
