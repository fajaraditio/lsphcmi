<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestScore extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scoring_component()
    {
        return $this->belongsTo(ScoringComponent::class);
    }

    public function scoring_criteria()
    {
        return $this->belongsTo(ScoringCriteria::class);
    }
}
