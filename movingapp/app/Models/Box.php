<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'max_weight',
        'width',
        'length',
        'height',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function objects()
    {
        return $this->hasMany(Object::class);
    }

    public function getCurrentWeight()
    {
        return $this->objects->sum('weight') ?? 0;
    }

    public function getWeightPercentage()
    {
        if (!$this->max_weight) return 0;
        
        $currentWeight = $this->getCurrentWeight();
        $percentage = ($currentWeight / $this->max_weight) * 100;
        
        return min(round($percentage, 2), 100);
    }

    public function getVolumePercentage()
    {
        if (!$this->width || !$this->length || !$this->height) return 0;
        
        $boxVolume = $this->width * $this->length * $this->height;
        
        $objectsVolume = $this->objects->reduce(function ($carry, $item) {
            if ($item->width && $item->length && $item->height) {
                return $carry + ($item->width * $item->length * $item->height);
            }
            return $carry;
        }, 0);
        
        $percentage = ($objectsVolume / $boxVolume) * 100;
        
        return min(round($percentage, 2), 100);
    }

    public function isOverweight()
    {
        if (!$this->max_weight) return false;
        return $this->getCurrentWeight() > $this->max_weight;
    }
}
