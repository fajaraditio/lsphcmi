<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoringComponent extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function scoring_criterias()
    {
        return $this->hasMany(ScoringCriteria::class);
    }
}
