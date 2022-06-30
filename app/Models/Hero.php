<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Hero extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'is_local',
        'height',
        'weight',
        'intelligence',
        'strength',
        'speed',
        'durability',
        'power',
        'combat',
        'publisher_id',
        'alignment_id',
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function alignment()
    {
        return $this->belongsTo(Alignment::class);
    }

    public function aliases()
    {
        return $this->hasMany(Alias::class);
    }

    public function getConvertedHeightAttribute()
    {
        $m = $this->height / 100 % 100;
        $cm = $this->height % 100;

        return $m . ' m ' . $cm . ' cm';
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('sm')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();


        $this->addMediaConversion('lg')
            ->fit(Manipulations::FIT_CROP, 600, 600)
            ->nonQueued();
    }
}
