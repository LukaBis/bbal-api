<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Season;

class League extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function seasons() {
        return $this->belongsToMany(Season::class);
    }
}
