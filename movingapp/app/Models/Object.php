<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'box_id',
        'user_id',
        'name',
        'weight',
        'width',
        'length',
        'height',
    ];

    public function box()
    {
        return $this->belongsTo(Box::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getVolume()
    {
        if (!$this->width || !$this->length || !$this->height) return 0;
        return $this->width * $this->length * $this->height;
    }
}